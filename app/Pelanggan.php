<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
     protected $fillable = [
        'user_id', 'alamat', 'koordinator_lokasi',
    ];
    public function user()
    {
        return $this->hasOne(User::class ,'id','user_id');
    }
}
