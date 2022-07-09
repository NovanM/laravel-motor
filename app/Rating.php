<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $fillable = [
        'layanan_id', 'rating','user_id','komplain'
    ];
    public function layanan()
    {
        return $this->hasOne(layanan::class ,'id','layanan_id');
    }
    public function user()
    {
        return $this->hasOne(User::class ,'id','user_id');
    }
}
