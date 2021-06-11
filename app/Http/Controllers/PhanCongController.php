<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
use App\UserDonVi;
use App\PhanCong;
use App\User;
use App\LoaiDanhMuc;
use App\DmDonViYeuCau;
use App\ChiTietPhanCong;

class PhanCongController extends Controller
{

    public function bangPhanCong(){
        $idUser=Auth::user()->id;
        $idDonVi=Auth::user()->id_don_vi;

        // loại danh mục lấy hết theo đơn vị cha parent = null
        $loaiDanhMucs=LoaiDanhMuc::select('loai_danh_muc.id','loai_danh_muc.ten_loai_danh_muc')
        ->join('users','loai_danh_muc.id_users','=','users.id')
        ->where('users.id_don_vi','=',$idDonVi)
        ->get()->toArray();


        // lấy danh sách nhân sự cùng phòng lên
        $dsUsers=array();
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
            $dsUsers=User::select('users.id','users.name')
            ->join('users_don_vi','users.id','=','users_don_vi.id_users')
            ->where('users_don_vi.id_don_vi','=',$idDonVi)
            ->get()->toArray();
        }

        // danh mục đơn vị hỗ trợ
        $idDonVi=Auth::user()->id_don_vi;
        $dmDonViYeuCaus=DmDonViYeuCau::select('dm_don_vi_yeu_cau.id','dm_don_vi_yeu_cau.ten_don_vi')
        ->join('users','dm_don_vi_yeu_cau.id_users','=','users.id')
        ->where('dm_don_vi_yeu_cau.state','=',1)->where('users.id_don_vi','=',$idDonVi)
        ->get()->toArray();


        return view('admin.phan-cong.bang-phan-cong', compact('dsUsers', 'loaiDanhMucs','dmDonViYeuCaus'));
    }

    public function taoBangPhanCong(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $phanCong=new PhanCong();
            $phanCong->id_user=RequestAjax::get('id_user');
            $phanCong->id_user_phan_cong=$idUser;
            $phanCong->id_loai_danh_muc=RequestAjax::get('id_loai_danh_muc');
            $phanCong->tu_ngay=RequestAjax::get('tu_ngay');
            $phanCong->den_ngay=RequestAjax::get('den_ngay');
            $phanCong->ghi_chu=RequestAjax::get('ghi_chu');
            $phanCong->state=RequestAjax::get('state');
            $phanCong->save();

            return array('error'=>0);
        }   
    }

    public function loadBangPhanCong(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $idDonVi=Auth::user()->id_don_vi;

            $dsPhanCong=PhanCong::select('u.name', 'phan_cong.id','phan_cong.id_loai_danh_muc','phan_cong.id_user','loai_danh_muc.ten_loai_danh_muc', 'phan_cong.tu_ngay','phan_cong.den_ngay', 'u2.name as nguoi_phan_cong')
            ->join('users as u','phan_cong.id_user','=','u.id')
            ->join('users as u2','phan_cong.id_user_phan_cong','=','u2.id')
            ->join('loai_danh_muc','phan_cong.id_loai_danh_muc','=','loai_danh_muc.id')
            ->where('u.id_don_vi','=',$idDonVi)
            ->get()->toArray();
            $view=view('admin.phan-cong.load-bang-phan-cong', compact('dsPhanCong'))->render();             
            return response()->json(['html'=>$view]);
        }        
    }

    public function xoaBangPhanCong(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $checkBangPhanCong=PhanCong::where('id','=',RequestAjax::get('id'))->where('id_user_phan_cong','=',$idUser)->get()->toArray();
            if(count($checkBangPhanCong)>0){
                $bangPhanCong=PhanCong::findOrFail(RequestAjax::get('id'));
                $bangPhanCong->delete();
                return array('error'=>0);
            }
                
            return array('error'=>1);
        }        
    }

    public function getBangPhanCongById(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $phanCong=PhanCong::find($id);
            $phanCong['error']=0;
            return $phanCong;
        }
        return array('error'=>1);
    }

    public function suaBangPhanCong(Request $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $id=RequestAjax::get('id');
            $data=RequestAjax::all();
            $data['id_user_phan_cong']=$idUser;
            $data['state']=1;
            
            $check=PhanCong::where('id','=',$id)->where('id_user_phan_cong','=',$idUser)->get()->toArray();
            if(count($check)>0){
                $phanCong=PhanCong::findOrFail($id);
                $phanCong->update($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền sửa dữ liệu này.');
            }                
        }    
        return array('error'=>'Lỗi, vui lòng liên hệ quản trị!');
    }

    public function loadChiTietBangPhanCong(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idPhanCong=RequestAjax::get('id_phan_cong');
            $chiTietPhanCongs=ChiTietPhanCong::select('chi_tiet_phan_cong.id','chi_tiet_phan_cong.id_dm_don_vi_yeu_cau','chi_tiet_phan_cong.tu_ngay','chi_tiet_phan_cong.den_ngay', 'chi_tiet_phan_cong.ghi_chu', 'dm_don_vi_yeu_cau.ten_don_vi')
            ->join('dm_don_vi_yeu_cau','chi_tiet_phan_cong.id_dm_don_vi_yeu_cau','=','dm_don_vi_yeu_cau.id')
            ->where('chi_tiet_phan_cong.id_phan_cong','=',$idPhanCong)
            ->get()->toArray();
            return $chiTietPhanCongs;
        }        
    }

    public function themChiTietBangPhanCong(RequestAjax $request){
        if(RequestAjax::ajax()){

            $chiTietPhanCong=new ChiTietPhanCong();
            $chiTietPhanCong->id_dm_don_vi_yeu_cau=RequestAjax::get('id_dm_don_vi_yeu_cau');
            $chiTietPhanCong->id_phan_cong=RequestAjax::get('id_phan_cong');
            $chiTietPhanCong->tu_ngay=RequestAjax::get('tu_ngay');
            $chiTietPhanCong->den_ngay=RequestAjax::get('den_ngay');
            $chiTietPhanCong->ghi_chu=RequestAjax::get('ghi_chu');
            $chiTietPhanCong->state=RequestAjax::get('state');
            $chiTietPhanCong->save();
            return array('error'=>0);
        }        
    }

    public function xoaChiTietBangPhanCong(RequestAjax $request){
        if(RequestAjax::ajax()){
           $idUser=Auth::user()->id;

            $checkChiTietBangPhanCong=ChiTietPhanCong::select('chi_tiet_phan_cong.id')
            ->join('phan_cong','chi_tiet_phan_cong.id_phan_cong','=','phan_cong.id')
            ->where('chi_tiet_phan_cong.id','=',RequestAjax::get('id'))->where('phan_cong.id_user_phan_cong','=',$idUser)->get()->toArray();
            if(count($checkChiTietBangPhanCong)>0){
                $chiTietPhanCong=ChiTietPhanCong::findOrFail(RequestAjax::get('id'));
                $chiTietPhanCong->delete();
                return array('error'=>0);
            }

        }        
    }

   
    
    
}
