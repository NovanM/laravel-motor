<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\LayananService;
use App\Rating;
use Illuminate\Http\Request;

class RatingControlller extends Controller
{
    //
    public function all(Request $request)   
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
   

       if ($id) {
        $rating = Rating::find($id);
        if ($rating) {
            return ResponseFormatter::success($rating, 'Data Layanan Service');
        }else{
            return ResponseFormatter::error(null,'Layanan Tidak Ada',404);
        }
       }
   
       $rating = Rating::with(['layanan_service'])->where('layanan_id', $request->id);

       return ResponseFormatter::success(
        $rating->paginate($limit),
        'Data List Layanan'
       );
    }
}
