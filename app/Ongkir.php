<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    //
    protected $fillable=[
        'layanan_id','ongkir'
    ];

    public function user()
    {
        return $this->hasOne(LayananService::class ,'id','layanan_id');
    }
}
