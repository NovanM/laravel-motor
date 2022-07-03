<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\StatusKerja;
use Illuminate\Http\Request;

class StatusKerjaControlller extends Controller
{
    //

    public function all(Request $request)   
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
       


       if ($id) {
        $statuskerja = StatusKerja::find($id);
        if ($statuskerja) {
            return ResponseFormatter::success($statuskerja, 'Data Layanan Service');
        }else{
            return ResponseFormatter::error(null,'Layanan Tidak Ada',404);
        }
       }

       $statuskerja = StatusKerja::with(['layanan_service'])->where('layanan_id', $id);

       return ResponseFormatter::success(
        $statuskerja->paginate($limit),
        'Data List Layanan'
       );
    }
    
}
