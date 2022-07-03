<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
        'nama','alamat','tanggal_masuk','nama_sparepart','telepon'
    ];


    public function getTanggalMasuk ($value){
        return Carbon::parse($value)->timestamp;
    }
}
