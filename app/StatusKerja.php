<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusKerja extends Model
{
    //
    protected $fillable = [
        'layanan_id', 'status_kerja', 'password','user_id','transaksi_id'
       
    ];

    public function layanan()
    {
        return $this->hasOne(LayananService::class ,'id','layanan_id');
    }
    public function user()
    {
        return $this->hasOne(User::class ,'id','user_id');
    }

    public function transaksi(){
        return $this->hasOne(Transaksi::class ,'id','transaksi_id');
    }
}
