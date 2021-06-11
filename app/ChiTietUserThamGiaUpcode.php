<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ChiTietUserThamGiaUpcode extends Authenticatable
{
    use Notifiable;
    protected $table='chi_tiet_users_tham_gia_upcode';

    protected $fillable = [
        'id', 'id_lich_upcode', 'id_users', 'state', 'ghi_chu'
    ];

    public $timestamps=false;
}
