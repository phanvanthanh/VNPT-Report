<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DanhMucLoi extends Authenticatable
{
    use Notifiable;
    protected $table='dm_loi';

    protected $fillable = [
        'id', 'id_user', 'id_don_vi', 'ds_don_vi_duoc_chia_se', 'ds_tai_khoan_duoc_chia_se', 'ten_dm_loi', 'link_video_loi', 'mo_ta', 'yeu_cau', 'cach_khac_phuc', 'link_video_cach_khac_phuc', 'id_huong_xu_ly', 'id_loai_danh_muc', 'state', 'ma_yeu_cau', 'loai'
    ];

    public $timestamps=false;

    public function User(){
        return $this->belongsTo('App\User');
    }

    public function DonVi(){
        return $this->belongsTo('App\DonVi');
    }

    public function HuongXuLy(){
        return $this->belongsTo('App\HuongXuLy');
    }

    public function LoaiDanhMuc(){
        return $this->belongsTo('App\LoaiDanhMuc');
    }
}
