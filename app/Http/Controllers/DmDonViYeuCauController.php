<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use App\DmDonViYeuCau;
use App\UserDonVi;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
class DmDonViYeuCauController extends Controller
{

    public function dmDonViYeuCau(){
        return view('admin.dm-don-vi-yeu-cau.dm-don-vi-yeu-cau');
    }

    public function loadDmDonViYeuCau(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;

        $dmDonViYeuCaus=array();
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
            $dmDonViYeuCaus=DmDonViYeuCau::select('dm_don_vi_yeu_cau.id', 'dm_don_vi_yeu_cau.ten_don_vi','dm_don_vi_yeu_cau.state','users.name')
            ->join('users_don_vi','dm_don_vi_yeu_cau.id_users','=','users_don_vi.id_users')
            ->join('users','dm_don_vi_yeu_cau.id_users','=','users.id')
            ->where('users_don_vi.id_don_vi','=',$idDonVi)
            ->get()->toArray();
            $view=view('admin.dm-don-vi-yeu-cau.load-dm-don-vi-yeu-cau', compact('dmDonViYeuCaus'))->render();             
            return response()->json(['html'=>$view]);
        }
        return array('error'=>0);

    }
    public function themDmDonViYeuCau(RequestAjax $request){
        $idUser=Auth::user()->id;
        // kiểm tra nếu trùng tên
        $dmDonViYeuCaus=DmDonViYeuCau::where('ten_don_vi','=',RequestAjax::get('ten_don_vi'))->get()->toArray();
        if(count($dmDonViYeuCaus)>0){
            return array('error'=>1);    
        }
        // nếu chưa có thì cho thêm
        $dmDonViYeuCau=new DmDonViYeuCau();
        $dmDonViYeuCau->id_users=$idUser;
        $dmDonViYeuCau->ten_don_vi=RequestAjax::get('ten_don_vi');
        $dmDonViYeuCau->parent=RequestAjax::get('parent');
        $dmDonViYeuCau->state=RequestAjax::get('state');
        $dmDonViYeuCau->save();
        return array('error'=>0);
    }
    public function xoaDmDonViYeuCau(RequestAjax $request){
        $idUser=Auth::user()->id;
        $dmDonViYeuCau=DmDonViYeuCau::where('id','=',RequestAjax::get('id'))->where('id_users','=',$idUser)->get()->toArray();
        if($dmDonViYeuCau){
            $dmDonViYeuCau=DmDonViYeuCau::findOrFail(RequestAjax::get('id'));
            $dmDonViYeuCau->delete();
            return array('error'=>0);
        }
        return array('error'=>1);
        
    }
    


    public function suaDmDonViYeuCau(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id_users']=$idUser;
            // kiểm tra
            $id=RequestAjax::get('id');
            $check=DmDonViYeuCau::where('id','=',$id)->where('id_users','=',$idUser)->get()->toArray();
            if(count($check)>0){ // nếu có
                $dmDonViYeuCau=DmDonViYeuCau::find($id);
                $dmDonViYeuCau->update($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền sửa dữ liệu này.');
            }
        }
        return array('error'=>1);
    }

    public function getDmDonViYeuCauById(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $dmDonViYeuCau=DmDonViYeuCau::findOrFail($id);
            $dmDonViYeuCau['error']=0;
            return $dmDonViYeuCau;
        }
        return array('error'=>'Vui lòng liên hệ quản trị!');
    }
    
}
