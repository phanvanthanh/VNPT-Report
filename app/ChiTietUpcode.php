<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ChiTietUpcode extends Authenticatable
{
    use Notifiable;
    protected $table='chi_tiet_upcode';

    protected $fillable = [
        'id', 'id_lich_upcode', 'id_users', 'id_dm_loi', 'tinh_trang', 'ghi_chu'
    ];

    public $timestamps=false;
}
