<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PhanCong extends Authenticatable
{
    use Notifiable;
    protected $table='phan_cong';

    protected $fillable = [
        'id', 'id_user', 'id_loai_danh_muc', 'tu_ngay', 'den_ngay', 'ghi_chu', 'id_user_phan_cong', 'state'
    ];

    public $timestamps=false;
}