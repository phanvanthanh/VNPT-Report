<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HuongXuLy extends Authenticatable
{
    use Notifiable;

    protected $table='huong_xu_ly';
    protected $fillable = [
        'id', 'id_user', 'ten_huong_xu_ly', 'state'
    ];
    public $timestamps=false;

    public function DonVi(){
        return $this->belongsTo('App\DonVi');
    }
}
