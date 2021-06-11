<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\DonVi;
use DB;
use Auth;
use Request as RequestAjax;
class DonViController extends Controller
{

    //
    public function donVi(){
        $idUser=Auth::user()->id; 
        $roleId=Auth::user()->role_id;
        $idDonVi=Auth::user()->id_don_vi;
        

        // nếu tài khoản thuộc nhóm quản trị cấp cao thì thấy hết đơn vị, ngượi lại thì chỉ thấy của đơn vị mình thôi (phần này xử lý trong  view và view helper)
        
        $donVis=DonVi::select('don_vi.id', 'don_vi.ten_don_vi', 'don_vi.dia_chi', 'don_vi.co_dinh', 'don_vi.parent', 'don_vi.fax', 'don_vi.di_dong', 'don_vi.parent', 'don_vi.state')
        ->get()->toArray();
            
        
    	return view('admin.don-vi.don-vi',compact('donVis'));
    }

    public function themDonVi(Request $request){

        $donVi=new DonVi();
        $idUser=Auth::user()->id; 
        $donVi->id_users=$idUser;
        $donVi->ten_don_vi=$request->ten_don_vi;
        $donVi->dia_chi=$request->dia_chi;
        $donVi->email=$request->email;
        $donVi->di_dong=$request->di_dong;
        $donVi->co_dinh=$request->co_dinh;
        $donVi->fax=$request->fax;
        $parent=null; 
        if($request->parent!='' && $request->parent!='Chọn đơn vị cha'){
        	$donViCha=DonVi::findOrFail($request->parent);
        	if($donViCha){
        		$parent=$request->parent;
        	}
        }
        $donVi->parent=$parent;

        $donVi->save();
    	return redirect()->intended('/admin/don-vi');
    }


    public function suaDonVi(Request $request){
        $id=$request->id;
        $donVi=DonVi::findOrFail($id);
        if($donVi){
            $donVi->ten_don_vi=$request->ten_don_vi;
            $donVi->dia_chi=$request->dia_chi;
            $donVi->email=$request->email;
            $donVi->di_dong=$request->di_dong;
            $donVi->co_dinh=$request->co_dinh;
            $donVi->fax=$request->fax;
            $parent=null;             
            if($request->parent!='' && $request->parent!='Chọn đơn vị cha'){
                $donViCha=DonVi::findOrFail($request->parent);
                if($donViCha){
                    $parent=$request->parent;
                }
            }
            $donVi->parent=$parent;

            if($request->state!='' && $request->state!='Chọn trạng thái'){
                $donVi->state=$request->state;
            }

            $donVi->save();
            return redirect()->intended('/admin/don-vi');
        }
    }


    public function xoaDonVi(Request $request){
        // nếu đơn vị chứa tài khoản quản trị thì ko được xóa
        if($request->id!=1){
            $donVi=DonVi::findOrFail($request->id);
            $donVi->delete();
        }
        
        return redirect()->intended('/admin/don-vi');


    }

    public function getThongTinDonVi(RequestAjax $request){

        if(RequestAjax::ajax()){
            $id=RequestAjax::get('id');
            $donVi=DonVi::find($id)->toArray();
            if(count($donVi)>0){
                $donVi['error']=0;
                return $donVi;
            }
            return array('error'=>1);
        }
        return array('error'=>1);
            
    }

    
}
