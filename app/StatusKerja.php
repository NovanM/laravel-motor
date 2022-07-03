<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusKerja extends Model
{
    //
    protected $fillable = [
        'layanan_id', 'status_kerja', 'password',
       
    ];

    public function user()
    {
        return $this->hasOne(LayananService::class ,'id','layanan_id');
    }
}
