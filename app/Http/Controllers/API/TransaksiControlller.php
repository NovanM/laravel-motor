<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return ResponseFormatter::success($transaction, 'Transaksi di berbaruhi');
    }
}
