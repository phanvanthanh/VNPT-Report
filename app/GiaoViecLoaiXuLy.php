<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaoViecLoaiXuLy extends Model
{
    protected $table='giao_viec_loai_xu_ly';
    protected $fillable=['id','ten_loai_xu_ly', 'trang_thai'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
