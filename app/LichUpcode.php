<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LichUpcode extends Authenticatable
{
    use Notifiable;
    protected $table='lich_upcode';

    protected $fillable = [
        'id', 'id_users', 'ten_lich_upcode', 'thoi_gian_bat_dau_du_kien', 'thoi_gian_ket_thuc_du_kien', 'thoi_gian_bat_dau', 'thoi_gian_ket_thuc', 'so_luong_nhan_su_tham_gia', 'state', 'id_loai_danh_muc'
    ];

    public $timestamps=false;
}
