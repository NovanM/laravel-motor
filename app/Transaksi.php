<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $fillable = [
        'user_id', 'layanan_id', 'total','sparepart_id',
        'status','paymen_url','nama_layanan','pelanggan_id','layanan_harga_sparepart','layanan_sparepart'
        
    ];

    public function user()
    {
        return $this->hasOne(User::class ,'id','user_id');
    }
    public function layanan()
    {
        return $this->hasOne(LayananService::class ,'id','layanan_id');
    }
    public function sparepart()
    {
        return $this->hasOne(Sparepart::class ,'id','sparepart_id');
    }
    public function pelanggan(){
        return $this->hasOne(Pelanggan::class,'id','pelanggan_id');
    }
    public function getCreatedAt ($value){
        return Carbon::parse($value)->timestamp;
    }
    public function getUpdateddAt ($value){
        return Carbon::parse($value)->timestamp;
    }

}
