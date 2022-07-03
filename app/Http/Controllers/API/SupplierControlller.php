<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Sparepart;
use App\Supplier;
use Exception;
use Illuminate\Http\Request;

class SupplierControlller extends Controller
{
    //

    public function inputSuplier(Request $request)
    {
        try {
            $request->validate([
            'nama' => ['required','string','max:255'],
            'nama_sparepart'=>['required','string'],
            ]);

           Supplier::create([
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'tanggal_masuk'=>$request->tanggal_masuk,
                'nama_sparepart'=>$request->nama_sparepart,
            ]);


            $supplier = Supplier::where('nama',$request->nama)->first();

            return ResponseFormatter::success(
                [
                    'supplier'=>$supplier
                ],'Created Supplier '
            );
        } catch(Exception $e){
            return ResponseFormatter::error([
                'message'=>'Something Wrong',
                'error'=>$e
            ],'Create supplier Failed' ,500);
        }
    }


    
}
