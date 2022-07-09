<?php

namespace App\Http\Controllers;

use App\LayananService;
use App\Pelanggan;
use App\Sparepart;
use App\Supplier;
use App\Transaksi;
use App\User;

use Illuminate\Http\Request;


class DashboardController extends Controller
{
    //
    public function index()
    {
        $pelanggan = count(Pelanggan::all());
        $supplier = count(Supplier::all());
        $mekanik = count(User::all()->where('role', 'mekanik'));
        $sparepart = count(Sparepart::all());
       
        $layanan = count(LayananService::all());
        $laporan = Transaksi::sum('total');
      
        return view('admin.dashboard', compact('pelanggan', 'supplier', 'mekanik', 'sparepart','layanan','laporan'));
    }
}
