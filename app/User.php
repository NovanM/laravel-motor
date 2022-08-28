<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Pelanggan;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'role','telepon','username','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getCreatedAt ($value){
        return Carbon::parse($value)->timestamp;
    }
    public function getUpdateddAt ($value){
        return Carbon::parse($value)->timestamp;
    }
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class ,'user_id','id');
    }
    public function rating()
    {
        return $this->hasMany(Rating::class ,'user_id','id');
    }
}

