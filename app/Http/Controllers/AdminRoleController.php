<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRoleRequest;
use App\AdminRole;
use Auth;
use App\DanhMuc;
use App\User;
use App\DonVi;
use Illuminate\Http\Request;
use DB;
use Request as RequestAjax;

class AdminRoleController extends Controller
{
    //

    public function taoNhomQuyenView(){
        $idUser=Auth::user()->id; 
        $roleId=Auth::user()->role_id;
        $idDonVi=Auth::user()->id_don_vi;

        $roles=AdminRole::where('id','!=',1)->where('id_don_vi','=',$idDonVi)->get();
        // không được xóa quyền của quản trị
        if($roleId==1){
            $roles=AdminRole::get();
        }

        // Quyền quản trị được chọn đơn vị của quyền, ngược lại mặc định là đơn vị của người tạo
        $donVis=DonVi::where('id','=',$idDonVi)->get()->toArray();
        if($roleId==1){
            $donVis=DonVi::where('state','=',1)->where('parent','=',null)->get()->toArray();
        }
        
    	return view('admin.role.tao-nhom-quyen',compact('roles','donVis'));
    }

    public function taoNhomQuyenPost(AdminRoleRequest $AdminRoleRequest){
        if($AdminRoleRequest->id_don_vi==''){
            return redirect()->intended('/admin/tao-nhom-quyen');
        }
    	$adminRole=new AdminRole();
        $adminRole->id_don_vi=$AdminRoleRequest->id_don_vi;
        $adminRole->role_name=$AdminRoleRequest->role_name;
        

        $adminRole->save();
    	return redirect()->intended('/admin/tao-nhom-quyen');
    }

    public function suaNhomQuyen(Request $request){

        $id=$request->id;

        $adminRole=AdminRole::findOrFail($id);
        if($adminRole){
            $adminRole->role_name=$request->role_name;
            if($request->state!='' && $request->state!='Chọn trạng thái'){
                $adminRole->state=$request->state;
            }

            $adminRole->save();
            return redirect()->intended('/admin/tao-nhom-quyen');
        }
    }

    public function xoaNhomQuyen(Request $request){
        $id=$request->id;

        $idDonVi=Auth::user()->id_don_vi;
        $roles=AdminRole::where('id','=',$id)->where('id_don_vi','=',$idDonVi)->get()->toArray();
        if($id!=1 && count($roles)>0){ // không xóa nhóm quyền của quản trị cao nhất
            // xóa
            $role=AdminRole::find($id);
            $role->delete();
        }
        return redirect()->intended('/admin/tao-nhom-quyen');
    }

    public function getThongTinNhomQuyen(RequestAjax $request){
        if(RequestAjax::ajax()){
            $id=RequestAjax::get('id');
            $adminRoles=AdminRole::where('admin_role.id','=',$id)
                ->get()
                ->toArray();
            if(!$adminRoles){
                return array('error'=>'Không tìm thấy nhân viên cần sửa');
            }
            $adminRoles[0]['error']=0;
            return $adminRoles[0];
        }
        
    }   
}


