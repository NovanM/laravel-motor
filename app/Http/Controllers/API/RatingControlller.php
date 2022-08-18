<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\LayananService;
use App\Rating;
use App\StatusKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingControlller extends Controller
{
    //
    public function all($id)
    {

        if ($id) {
            $rating = Rating::where('transaksi_id', $id)->with(['transaksi','status.user'])->first();
        }else if ($id==0){
            // $rating = Rating::where('user_id', Auth::user()->id)->get();
            $rating = Rating::with(['transaksi','status.user'])->orderBy('created_at','desc')->get();
        }
        return ResponseFormatter::success(
            $rating,
            'Data List Rating'
        );
    }



    public function create(Request $request)
    {
        $statuskerja = StatusKerja::where('transaksi_id', $request->transaksi_id)->first();
       if ($statuskerja != null) {
        $rating = Rating::create([
            'layanan_id' => $statuskerja->layanan_id,
            'rating'=> $request->rating,
            'user_id'=> $statuskerja->user_id,
            'komplain'=> $request->komplain,
            'transaksi_id'=>$statuskerja->transaksi_id,
        ]);
       }else{
        $rating = Rating::create([
            'layanan_id' => 0,
            'rating'=> $request->rating,
            'user_id'=> Auth::user()->id,
            'komplain'=> $request->komplain,
            'transaksi_id'=>$request->transaksi_id,
        ]);
       }

        $newrating = Rating::where('transaksi_id', $rating->transaksi_id)->with(['transaksi','status.user'])->first();
        return ResponseFormatter::success($newrating, 'Rating Created');
    }
}
