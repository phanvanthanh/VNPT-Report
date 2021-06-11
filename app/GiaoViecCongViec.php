<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaoViecCongViec extends Model
{
    protected $table='giao_viec_cong_viec';
    protected $fillable=['id','id_user_tao', 'id_muc_do_cong_viec', 'id_loai_danh_muc', 'ma_cong_viec', 'ten_cong_viec', 'noi_dung_cong_viec', 'ghi_chu_cong_viec', 'tai_lieu_cong_viec', 'han_xu_ly_cong_viec', 'ngay_gio_tao', 'sap_xep', 'trang_thai'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
