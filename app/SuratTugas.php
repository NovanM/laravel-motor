<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    //
    protected $fillable = ['harga_total', 'nama_pelanggan', 'layanan_id','nama_mekanik'];

    public function layanan()
    {
        return $this->hasOne(LayananService::class ,'id','layanan_id');
    }    
}
