<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use Request;
use App\AdminRole;
use App\AdminRule;
use App\AdminResource;
use Auth;
use DB;



class AdminRuleController extends Controller
{
    //
    public function phanQuyenGet(){
        $idUser=Auth::user()->id; 
        $roleId=Auth::user()->role_id;
        $idDonVi=Auth::user()->id_don_vi;

    	$roles=AdminRole::where('id','!=',1)->where('id_don_vi','=',$idDonVi)->get();

        if($roleId==1){
            $roles=AdminRole::get();
        }
    	$resource=AdminResource::get();
        // nếu tài khoản quản trị và tài khoản mặt định sẽ khác nhé
        $resource=array();
        if($roleId==1){
            $resource=DB::select('
                select * from admin_resource
            ');
            $adminResources=\DB::select('
                select
                    adre.id, adre.parent_id, adre.ten_hien_thi, adre.uri, adre.icon
                from users as u
                left join admin_rule as adru on u.role_id=adru.role_id
                left join admin_resource as adre on adru.resource_id=adre.id
                where u.id="'.$idUser.'" and adre.show_menu=1
                order by adre.order
            ');
        }
        else{
            $resource=DB::select('
                select t4.* from users as t1
                left join admin_role as t2 on t1.role_id=t2.id
                left join admin_rule as t3 on t2.id=t3.role_id
                left join admin_resource as t4 on t3.resource_id=t4.id
                where t1.id='.$idUser.' and t3.role_id='.$roleId
            );

            $adminResources=\DB::select('
                select
                    adre.id, adre.parent_id, adre.ten_hien_thi, adre.uri, adre.icon
                from users as u
                left join admin_rule as adru on u.role_id=adru.role_id
                left join admin_resource as adre on adru.resource_id=adre.id
                where u.id="'.$idUser.'" and adre.show_menu=1
                order by adre.order
            ');
        }
            
    	return view('admin.rule.phan-quyen',compact('roles','resource', 'adminResources'));
    }

    public function phanQuyenPost(HttpRequest $request){
    

    	$role_id=$request->role_id;
    	$rule=AdminRule::where('role_id','=',$role_id);
    	$rule->delete();
        if(count($request->resource_id)<=0){
            return redirect()->intended('/admin/phan-quyen');
        }
		foreach ($request->resource_id as $key => $resource_id) {
            $resource=AdminResource::where('id','=',$resource_id)->get()->toArray();
            if(count($resource)>0){
                $admin_rule=new AdminRule();
                $admin_rule->resource_id=$resource_id;
                $admin_rule->role_id=$role_id;
                $admin_rule->save();
            }
    			
		}
    	return redirect()->intended('/admin/phan-quyen');

    }

	public function danhSachQuyenPost(){
		if(Request::ajax()){
			$role_id=Request::get('role_id');
			$resource=AdminResource::select('admin_resource.id as resource_id', 'admin_rule.id as rule_id', 'admin_role.id as role_id')
    						->leftJoin('admin_rule', 'admin_resource.id', '=', 'admin_rule.resource_id')
    						->leftJoin('admin_role','admin_rule.role_id','=','admin_role.id')
    						->where('admin_role.id','=',$role_id)
    						->get()
    						->toArray();
	    	
			return $resource;
		}
    	
    }    
}
