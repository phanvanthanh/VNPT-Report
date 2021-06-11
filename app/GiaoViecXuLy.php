<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaoViecXuLy extends Model
{
    protected $table='giao_viec_xu_ly';
    protected $fillable=['id','id_cong_viec','id_user_xu_ly', 'id_loai_xu_ly', 'ngay_gio_xu_ly', 'noi_dung_xu_ly', 'file_xu_ly', 'trang_thai'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
