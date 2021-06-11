<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'id_app', 'di_dong', 'id_don_vi', 'id_chuc_danh'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function AdminRole(){
        return $this->belongsTo('App\AdminRole');
    }
    public function HoaDon(){
        return $this->hasMany('App\HoaDon');
    }
    public function PhieuChi(){
        return $this->hasMany('App\PhieuChi');
    }
    public function PhieuHen(){
        return $this->hasMany('App\PhieuHen');
    }
    public function PhieuNhap(){
        return $this->hasMany('App\PhieuNhap');
    }
    public function PhieuThu(){
        return $this->hasMany('App\PhieuThu');
    }
    public function SanPham(){
        return $this->hasMany('App\SanPham');
    }
}
