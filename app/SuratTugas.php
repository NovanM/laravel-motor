<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    //
    protected $fillable = ['harga_total', 'nama_pelanggan', 'layanan_id'];

    public function layanan()
    {
        return $this->hasOne(layanan::class ,'id','layanan_id');
    }    
}
