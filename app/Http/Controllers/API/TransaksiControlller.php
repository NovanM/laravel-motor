<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\LayananService;
use App\Pelanggan;
use App\Sparepart;
use App\StatusKerja;
use App\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class TransaksiControlller extends Controller
{
    //
    public function all($pelanggan)
    {
       
   
        if ($pelanggan) {
            $transaction = Transaksi::with(['pelanggan','user'])->where('pelanggan_id', $pelanggan)->get();
        }else if($pelanggan == 0){
            $transaction = Transaksi::with(['pelanggan','user'])->whereIn('status',['SUCCESS','success'])->get();
        }

        return ResponseFormatter::success(
                $transaction,
            'Data transaksi'
        );
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaksi::findOrFail($id);
        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaksi di perbaruhi');
    }


    public function checkout(Request $request)
    {
        $request->validate([
            'total' => 'required',
            'status' => 'required',
        ]);

        if ($request->layanan_id != null) {
            $namaLayanan = LayananService::find($request->layanan_id);
            
            $transaction = Transaksi::create([
                'layanan_id' => $request->layanan_id,
                'user_id' => $request->user()->id,
                'nama_layanan' => $namaLayanan->jenis_layanan,
                'total' => $request->total,
                'status' => $request->status,
                'pelanggan_id' =>0,
                'payment_url' => '',
            ]);
        } else {
            $namaLayanan = Sparepart::find($request->sparepart_id);
            $transaction = Transaksi::create([
                'sparepart_id' => $request->sparepart_id,
                'user_id' => $request->user()->id,
                'nama_layanan' => $namaLayanan->nama,
                'total' => $request->total,
                'status' => $request->status,
                'pelanggan_id'=>0,
                'payment_url' => '',
            ]);
        }

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');


        $transaction = Transaksi::with(['layanan', 'user', 'sparepart'])->find($transaction->id);

        $midtrans = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int) $transaction->total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            // 'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            $idPelanggan = Pelanggan::where('user_id', $transaction->user_id)->first();

            
            $transaction->payment_url = $paymentUrl;
            $transaction->pelanggan_id = $idPelanggan->id;
            $transaction->save();
    
            return ResponseFormatter::success($transaction, 'Tranksaksi berhasil');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 'Transaksi Gagal');
        }
    }

    public function callback(Request $request)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $notification = new Notification();


        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        $transaction = Transaksi::findOrFail($order_id);


        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                } else {
                    $transaction->status = 'SUCCESS';
                    if ($transaction->sparepart_id != null) {
                        $sparepart = Sparepart::findOrFail($transaction->sparepart_id);
                        $dataStok = $sparepart->stok;
                        $dataStok = $dataStok - 1;
                        $sparepart->stok = $dataStok;
                        $sparepart->save();
                    }
                    if ($transaction->layanan_id != null) {
                        $status_kerja = StatusKerja::create([
                            'transaksi_id' => $transaction->id,
                            'layanan_id' => $transaction->layanan_id,
                            //Check Mekanik User
                            'user_id' => $transaction->user->id,
                            'status_kerja' => 'Diterima'
    
                        ]);
                        $status_kerja->save();
                    }
                }
            }
        } else if ($status == 'settlement') {
            $transaction->status = 'SUCCESS';
            if ($transaction->sparepart_id != null) {
                $sparepart = Sparepart::findOrFail($transaction->sparepart_id);
                $dataStok = $sparepart->stok;
                $dataStok = $dataStok - 1;
                $sparepart->stok = $dataStok;
                $sparepart->save();
            }
            if ($transaction->layanan_id != null) {
                $status_kerja = StatusKerja::create([
                    'transaksi_id' => $transaction->id,
                    'layanan_id' => $transaction->layanan_id,
                    //Check Mekanik User
                    'user_id' => $transaction->user->id,
                    'status_kerja' => 'Diterima'

                ]);
                $status_kerja->save();
            }
        } else if ($status == 'pending') {
            $transaction->status = 'PENDING';
        } else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        } else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        } else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }


        $transaction->save();
    }
}
