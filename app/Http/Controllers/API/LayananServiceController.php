<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\LayananService;
use Illuminate\Http\Request;

class LayananServiceController extends Controller
{
    //
    public function all(Request $request)   
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('nama');


       if ($id) {
        $layananService = LayananService::find($id);
        if ($layananService) {
            return ResponseFormatter::success($layananService, 'Data Layanan Service');
        }else{
            return ResponseFormatter::error(null,'Layanan Tidak Ada',404);
        }
       }

       $layananService = LayananService::query();

       if ($name) {
        $layananService->where('nama', 'like','%'.$name.'%');
       }


       return ResponseFormatter::success(
        $layananService->paginate($limit),
        'Data List Layanan'
       );
    }
}
