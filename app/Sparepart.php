<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    //
    protected $fillable = [
        'suplier_id', 'kode', 'nama','nama_sparepart',
        'stok','harga','images','harga_jual'
    ];

    public function supplier()
    {
        return $this->hasOne(Supplier::class ,'id','suplier_id');
    }
    //test
}


