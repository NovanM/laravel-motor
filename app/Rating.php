<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $fillable = [
        'layanan_id', 'rating'
    ];
    public function layanan()
    {
        return $this->hasOne(layanan::class ,'id','layanan_id');
    }
}
