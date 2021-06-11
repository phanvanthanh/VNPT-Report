<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\DmChucVu;
use App\UserDonVi;
use App\DmDonViYeuCau;
use App\CanBo;
use DB;
use Auth;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
class CanBoController extends Controller
{

    public function canBo(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;

        $dmDonViYeuCaus=array();
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
            $dmDonViYeuCaus=DmDonViYeuCau::select('dm_don_vi_yeu_cau.id', 'dm_don_vi_yeu_cau.ten_don_vi')
            ->join('users_don_vi','dm_don_vi_yeu_cau.id_users','=','users_don_vi.id_users')
            ->join('users','dm_don_vi_yeu_cau.id_users','=','users.id')
            ->where('users_don_vi.id_don_vi','=',$idDonVi)
            ->get()->toArray();
        }

        $dmChucVus=DmChucVu::where('state','=',1)->get()->toArray();
        return view('admin.can-bo.can-bo',compact('dmDonViYeuCaus','dmChucVus'));
    }

    public function loadCanBo(RequestAjax $request){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;

        $canBos=array();
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
            $canBos=CanBo::select('can_bo.id','can_bo.ten_can_bo','can_bo.di_dong','can_bo.dia_chi','can_bo.state','dm_chuc_vu.ten_chuc_vu','dm_don_vi_yeu_cau.ten_don_vi','can_bo.state')
            ->join('dm_don_vi_yeu_cau','can_bo.id_dm_don_vi_yeu_cau','=','dm_don_vi_yeu_cau.id')
            ->join('dm_chuc_vu','can_bo.id_chuc_vu','=','dm_chuc_vu.id')
            ->join('users_don_vi','can_bo.id_user','=','users_don_vi.id_users')
            ->where('users_don_vi.id_don_vi','=',$idDonVi)
            ->get()->toArray();
            $view=view('admin.can-bo.load-can-bo', compact('canBos'))->render();             
            return response()->json(['html'=>$view]);
        }
        return array('error'=>0);
    }
    public function themCanBo(RequestAjax $request){
        $idUser=Auth::user()->id;
        $canBo=new CanBo();
        $canBo->id_user=$idUser;
        $canBo->ten_can_bo=RequestAjax::get('ten_can_bo');
        $canBo->id_dm_don_vi_yeu_cau=RequestAjax::get('id_dm_don_vi_yeu_cau');
        $canBo->di_dong=RequestAjax::get('di_dong');
        $canBo->id_chuc_vu=RequestAjax::get('id_chuc_vu');
        $canBo->dia_chi=RequestAjax::get('dia_chi');
        $canBo->state=RequestAjax::get('state');
        $canBo->save();
        return array('error'=>0);
    }
    public function xoaCanBo(RequestAjax $request){
        $idUser=Auth::user()->id;
        $canBos=CanBo::where('id','=',RequestAjax::get('id'))->where('id_user','=',$idUser)->get()->toArray();
        if($canBos){
            $canBo=CanBo::findOrFail(RequestAjax::get('id'));
            $canBo->delete();
            return array('error'=>0);
        }
        return array('error'=>1);
    }
    public function suaCanBo(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id_user']=$idUser;
            // kiểm tra
            $id=RequestAjax::get('id');
            $check=CanBo::where('id','=',$id)->where('id_user','=',$idUser)->get()->toArray();
            if(count($check)>0){ // nếu có
                $canBo=CanBo::find($id);
                $canBo->update($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền sửa dữ liệu này.');
            }
        }
        return array('error'=>1);
    }

    public function getCanBoById(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $canBo=CanBo::find($id);
            $canBo['error']=0;
            return $canBo;
        }
        return array('error'=>'Vui lòng liên hệ quản trị!');
    }
    
    
}
