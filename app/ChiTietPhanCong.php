<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ChiTietPhanCong extends Authenticatable
{
    use Notifiable;
    protected $table='chi_tiet_phan_cong';

    protected $fillable = [
        'id', 'id_dm_don_vi_yeu_cau', 'tu_ngay', 'den_ngay', 'ghi_chu', 'state'
    ];

    public $timestamps=false;
}
