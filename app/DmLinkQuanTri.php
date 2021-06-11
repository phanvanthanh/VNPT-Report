<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DmLinkQuanTri extends Authenticatable
{
    use Notifiable;
    protected $table='dm_link_quan_tri';

    protected $fillable = [
        'id', 'id_users', 'link', 'ds_don_vi_duoc_chia_se', 'ds_tai_khoan_duoc_chia_se', 'ten_link', 'mo_ta', 'state', 'id_loai_danh_muc'
    ];

    public $timestamps=false;
}
