<?php

namespace App\Exports;

use App\Transaksi;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromArray,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($dari,$sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }
    
    
    public function array():array
    {   
        $data = [];
        $i=0;
        $transaction = Transaksi::with('user','layanan','sparepart')->whereDate('created_at','>=', $this->dari)->whereDate('created_at','<=',$this->sampai)->orderBy('created_at','desc')->get();
        foreach ($transaction as $value) {
            if ($value->layanan != null) {
                array_push($data,[
                 'No'=>++$i,
                 'ID Transaksi' => '000'.$value->id,
                 'Layanan'=>'Service '.$value->layanan->jenis_layanan,
                 'Waktu Transaksi'=>date('d F Y h:m:s', strtotime($value->created_at)),
                 'Nama Pelanggan'=>$value->user->name,
                 'Total'=>$value->total,
                 'Link Pembayaran'=>$value->payment_url,
                ]);
            }else{
                array_push($data,[
                    'No'=>++$i,
                    'ID Transaksi' => '000'.$value->id,
                    'Layanan'=>'Pembelian '.$value->sparepart->nama,
                    'Waktu Transaksi'=>date('d F Y h:m:s', strtotime($value->created_at)),
                    'Nama Pelanggan'=>$value->user->name,
                    'Total'=>$value->total,
                    'Link Pembayaran'=>$value->payment_url,
                   ]);
            }
        }
        return $data;
    }



    public function headings(): array{
        return [
            'No',
            'ID Transaksi',
            'Layanan',
            'Waktu Transaksi',
            'Nama Pelanggan',
            'Total',
            'Link Pembayaran'                
        ];
    }
}
