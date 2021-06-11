<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaoViecMucDo extends Model
{
    protected $table='giao_viec_muc_do';
    protected $fillable=['id','ten_muc_do', 'trang_thai'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
