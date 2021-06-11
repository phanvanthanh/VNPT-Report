<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table='admin_role';
    protected $fillable=['id','role_name', 'id_don_vi', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
    public function User(){
    	return $this->hasMany('App\User');
    }

    public function AdminRule(){
    	return $this->hasMany('App\AdminRule');
    }
}
