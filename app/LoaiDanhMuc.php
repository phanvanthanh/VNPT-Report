<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LoaiDanhMuc extends Authenticatable
{
    use Notifiable;

    protected $table='loai_danh_muc';
    protected $fillable = [
        'id', 'id_users', 'ten_loai_danh_muc', 'state'
    ];
    public $timestamps=false;

    public function DonVi(){
        return $this->belongsTo('App\DonVi');
    }

    public static function getLoaiDanhMuc(){
    	$loaiDanhMucs=LoaiDanhMuc::where('state','=',1)->get()->toArray();
    	return $loaiDanhMucs;
    }
}
