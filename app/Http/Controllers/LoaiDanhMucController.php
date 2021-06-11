<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\LoaiDanhMuc;
use DB;
use Auth;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
class LoaiDanhMucController extends Controller
{

    public function loaiDanhMuc(){
        return view('admin.loai-danh-muc.loai-danh-muc');
    }

    public function loadLoaiDanhMuc(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $loaiDanhMucs=array();
        $loaiDanhMucs=LoaiDanhMuc::select('loai_danh_muc.id', 'loai_danh_muc.ten_loai_danh_muc', 'loai_danh_muc.id_users','loai_danh_muc.state', 'users.name')
        ->join('users','loai_danh_muc.id_users','=','users.id')
        ->where('users.id_don_vi','=',$idDonViGoc)
        ->get()->toArray();
        $view=view('admin.loai-danh-muc.load-loai-danh-muc', compact('loaiDanhMucs'))->render();             
        return response()->json(['html'=>$view]);
    }

    public function themLoaiDanhMuc(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        // kiểm tra có tồn tại hay chưa
        $loaiDanhMucs=LoaiDanhMuc::select('loai_danh_muc.id')
        ->join('users','loai_danh_muc.id_users','=','users.id')
        ->where('users.id_don_vi','=',$idDonViGoc)->where('loai_danh_muc.ten_loai_danh_muc','=',RequestAjax::get('ten_loai_danh_muc'))
        ->get()->toArray();
        if($loaiDanhMucs){
            return array('error'=>1);    
        }
        // nếu chưa có thì cho thêm
        $loaiDanhMuc=new LoaiDanhMuc();
        $loaiDanhMuc->id_users=$idUser;
        $loaiDanhMuc->ten_loai_danh_muc=RequestAjax::get('ten_loai_danh_muc');
        $loaiDanhMuc->state=RequestAjax::get('state');
        $loaiDanhMuc->save();
        return array('error'=>0);    
    }

    public function xoaLoaiDanhMuc(){
        $idUser=Auth::user()->id;
        $loaiDanhMuc=LoaiDanhMuc::where('id','=',RequestAjax::get('id'))->where('id_users','=',$idUser)->get()->toArray();
        if($loaiDanhMuc){
            $loaiDanhMuc=LoaiDanhMuc::findOrFail(RequestAjax::get('id'));
            $loaiDanhMuc->delete();
            return array('error'=>0);
        }
        return array('error'=>1);
    }



    public function suaLoaiDanhMuc(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id_users']=$idUser;
            // kiểm tra
            $id=RequestAjax::get('id');
            $check=LoaiDanhMuc::where('id','=',$id)->where('id_users','=',$idUser)->get()->toArray();
            if(count($check)>0){ // nếu có
                $loaiDanhMuc=LoaiDanhMuc::find($id);
                $loaiDanhMuc->update($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền sửa dữ liệu này.');
            }
        }
        return array('error'=>1);
    }


    public function getLoaiDanhMucById(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $loaiDanhMuc=LoaiDanhMuc::findOrFail($id);
            $loaiDanhMuc['error']=0;
            return $loaiDanhMuc;
        }
        return array('error'=>'Vui lòng liên hệ quản trị!');
    }
    
}
