<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\StatusKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusKerjaControlller extends Controller
{
    //

    public function all($id)   
    {
       
       
       if ($id) {
        $statuskerja = StatusKerja::where('transaksi_id',$id)->first();
       }

       return ResponseFormatter::success(
        $statuskerja,
        'Data List Status Kerja'
       );
    }

    public function update(Request $request, $id)
    {
        $statuskerja = StatusKerja::where('transaksi_id',$id)->first();
        $statuskerja->user_id = Auth::user()->id;
        $statuskerja->update($request->all());

        return ResponseFormatter::success($statuskerja, 'Status Kerja di perbaruhi');
    }

    
}
