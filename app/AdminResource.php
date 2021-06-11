<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdminResource;

class AdminResource extends Model
{
    protected $table='admin_resource';
    protected $fillable=['id', 'ten_hien_thi','resource', 'controller', 'action', 'uri', 'parameter', 'id_menu', 'parent_id', 'status', 'show_menu','uri', 'use_when_login', 'only_show_admin', 'id_app', 'order'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
    public function AdminRule(){
    	return $this->hasMany('App\AdminRule');
    }
    public function Menu(){
    	return $this->hasMany('App\AdminMenu');
    }
}
