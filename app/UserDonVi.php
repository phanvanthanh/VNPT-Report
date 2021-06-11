<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDonVi extends Model
{
    protected $table='users_don_vi';
    protected $fillable=['id','id_users','id_don_vi', 'ngay_bat_dau_cong_tac', 'ngay_ket_thuc_cong_tac', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
