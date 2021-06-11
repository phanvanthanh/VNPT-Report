<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ThongTinHoTro extends Authenticatable
{
    use Notifiable;
    protected $table='thong_tin_ho_tro';

    protected $fillable = [
        'id', 'id_users', 'id_dm_loi', 'id_dm_don_vi_yeu_cau', 'so_lan_ho_tro', 'ngay_ho_tro', 'ghi_chu', 'state'
    ];

    public $timestamps=false;
}
