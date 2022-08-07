<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\LayananService;
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
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $layanan_id = $request->input('layanan_id');


        if ($id) {
            $transaction = Transaksi::with(['layanan_service', 'user'])->find($id);
            if ($transaction) {
                return ResponseFormatter::success($transaction, 'Data tranksaksi Berhasil');
            } else {
                return ResponseFormatter::error(null, 'Transaksi Tidak Ada', 404);
            }
        }

        $transaction = Transaksi::with(['layanan_service', 'user'])
            ->where('user_id', Auth::user()->id);

        if ($layanan_id) {
            $transaction->where('layanan_id', $layanan_id);
        }


        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data transaksi'
        );
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaksi::findOrFail($id);
        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaksi di perbaruhi');
    }


    public function checkout(Request $request){
        $request->validate([
            'total'=>'required',
            'status'=>'required',
        ]);

        if ($request->layanan_id != null) {
            $namaLayanan = LayananService::find($request->layanan_id);
            $transaction = Transaksi::create([
                'layanan_id' => $request->layanan_id,
                'user_id'=>$request->user()->id,
                'nama_layanan' => $namaLayanan->jenis_layanan,
                'total'=>$request->total,
                'status'=>$request->status,
                'payment_url'=>'',
            ]);

            $status_kerja = StatusKerja::create([
                'transaksi_id'=>$transaction->id,
                'layanan_id'=>$request->layanan_id,
                //Check Mekanik User
                'user_id'=>$request->user()->id,
                'status_kerja'=>'Diterima'
                
            ]);

        }else{
            $namaLayanan = Sparepart::find($request->sparepart_id);
            $transaction = Transaksi::create([
                'sparepart_id' => $request->sparepart_id,
                'user_id'=>$request->user()->id,
                'nama_layanan'=>$namaLayanan->nama,
                'total'=>$request->total,
                'status'=>$request->status,
                'payment_url'=>'',
            ]);
        }

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
   

        $transaction = Transaksi::with(['layanan','user','sparepart'])->find($transaction->id);

        $midtrans = [
            'transaction_details'=>[
                'order_id' => $transaction->id,
                'gross_amount'=>(int) $transaction->total,
            ],
            'customer_details' =>[
                'first_name' => $transaction->user->name,
                'email'=>$transaction->user->email,
            ],
            'enabled_payments'=>['gopay','bank_transfer'],
            'vtweb'=>[]
        ];

        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();
            if ($request->layanan_id != null) {
                $status_kerja->save();
            }

            return ResponseFormatter::success($transaction,'Tranksaksi berhasil');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(),'Transaksi Gagal');
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

        if($status == 'capture'){
            if ($type == 'credit_card') {
                if($fraud == 'challenge'){
                    $transaction->status = 'PENDING';
                }
                else{
                    $transaction->status ='SUCCESS';
                }
            }
        }else if($status == 'settlement'){
            $transaction->status ='SUCCESS';
        }else if($status == 'pending'){
            $transaction->status = 'PENDING';
        }else if($status == 'deny'){
            $transaction->status = 'CANCELLED';
        }else if($status == 'expire'){
            $transaction->status = 'CANCELLED';
        }else if($status == 'cancel'){
            $transaction->status = 'CANCELLED';
        }


        $transaction->save();
    }




    

}
