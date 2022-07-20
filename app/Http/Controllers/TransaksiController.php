<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function index()
    {

        $pagename = 'Data Laporan Transaksi';
        $allTransaksi = Transaksi::all();
        return view('admin.transaksi.index', compact('pagename', 'allTransaksi'));

    }


    
    public function success()
    {
        return view('midtrans.success');
    }

    public function unfinish()
    {
        return view('midtrans.unfinish');
    }
    
    public function error()
    {
        return view('midtrans.error');
    }
}
