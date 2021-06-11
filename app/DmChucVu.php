<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DmChucVu extends Authenticatable
{
    use Notifiable;

    protected $table='dm_chuc_vu';
    protected $fillable = [
        'id', 'ten_chuc_vu', 'state'
    ];
    public $timestamps=false;
}
