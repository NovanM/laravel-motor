<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayananService extends Model
{
    //
    protected $fillable = [
        'jenis_layanan', 'keterangan', 'harga','sparepart_id'
    ];
    
}
