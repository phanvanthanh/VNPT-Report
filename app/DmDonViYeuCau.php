<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmDonViYeuCau extends Model
{
    protected $table='dm_don_vi_yeu_cau';
    protected $fillable=['id','id_users','ten_don_vi', 'parent', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
