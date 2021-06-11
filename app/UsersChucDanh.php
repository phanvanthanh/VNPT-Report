<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersChucDanh extends Model
{
    protected $table='users_chuc_danh';
    protected $fillable=['id','id_loai_chuc_danh', 'ten_chuc_danh', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
