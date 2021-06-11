<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaoCaoNghiBu extends Authenticatable
{
    use Notifiable;
    protected $table='bao_cao_nghi_bu';

    protected $fillable = [
        'id', 'id_users', 'id_users_duyet', 'id_lich_upcode', 'noi_dung_nghi_bu', 'ds_tai_khoan_duoc_chia_se', 'ds_don_vi_duoc_chia_se', 'thoi_gian_yeu_cau_nghi_bu', 'thoi_gian_duoc_duyet_nghi_bu', 'ngay_gui_yeu_cau', 'ngay_duyet', 'state'
    ];

    public $timestamps=false;
}
