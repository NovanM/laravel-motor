<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Sparepart;
use Illuminate\Http\Request;

class SparePartControlller extends Controller
{
    //
    public function all(Request $request)   
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('nama');


       if ($id) {
        $sparePart = Sparepart::find($id);
        if ($sparePart) {
            return ResponseFormatter::success($sparePart, 'Sparepart Service');
        }else{
            return ResponseFormatter::error(null,'Sparepart Tidak Ada',404);
        }
       }

       $sparePart = Sparepart::query();

       if ($name) {
        $sparePart->where('nama', 'like','%'.$name.'%');
       }


       return ResponseFormatter::success(
        $sparePart->paginate($limit),
        'Data List Sparepart'
       );
    }
}
