<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaoViecUserCongViec extends Model
{
    protected $table='giao_viec_user_cong_viec';
    protected $fillable=['id','id_cong_viec','id_user_giao', 'id_user_thuc_hien', 'xu_ly', 'trang_thai'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}