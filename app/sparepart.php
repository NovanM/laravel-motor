<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    //
    //
    protected $fillable = [
        'suplier_id', 'kode', 'nama',
        'stok','harga','images'
    ];

    public function supplier()
    {
        return $this->hasOne(Supplier::class ,'id','suplier_id');
    }
}
