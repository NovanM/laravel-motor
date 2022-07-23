<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Transaksi;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class TransaksiController extends Controller
{
    //
    public function index()
    {
        $pagename = 'Data Laporan Transaksi';
        $allTransaksi = Transaksi::orderBy('created_at','desc')->get();
        $total = Transaksi::sum('total');

       

        return view('admin.transaksi.index', compact('pagename', 'allTransaksi','total', ));

    }

    public function periodic(Request $request)
    {
        try{
            $dari = $request->dari;
            $sampai = $request->sampai;
            $total = Transaksi::whereDate('created_at','>=', $dari)->whereDate('created_at','<=',$sampai)->sum('total');
            $pagename = 'Data Laporan Transaksi '.$request->$dari .'sampai '.$request->sampai;
            $allTransaksi = Transaksi::whereDate('created_at','>=', $dari)->whereDate('created_at','<=',$sampai)->orderBy('created_at','desc')->get();
            return view('admin.transaksi.index', compact('pagename', 'allTransaksi','total',));

        }catch(\Exception $e){
            Session::flush('gagal',$e->getMessage());
            redirect()->back();
        }
    }
    public function exportExcel(Request $request)
    {   
     
        $date_mount = date('F');
        return Excel::download(new TransaksiExport($request->dari_ke,$request->sampai_ke), "$date_mount Transaksi.xlsx");
        

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
