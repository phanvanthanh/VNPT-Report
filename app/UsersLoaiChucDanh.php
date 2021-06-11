<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersLoaiChucDanh extends Model
{
    protected $table='users_loai_chuc_danh';
    protected $fillable=['id','ten_loai_chuc_danh', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
