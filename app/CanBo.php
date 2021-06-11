<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CanBo extends Model
{
    protected $table='can_bo';
    protected $fillable=['id','id_user','ten_can_bo','id_dm_don_vi_yeu_cau', 'di_dong', 'dia_chi', 'id_chuc_vu', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
