<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use App\UserDonVi;
use App\DonVi;
use App\BaoCaoNghiBu;
use App\DmLinkQuanTri;
use App\LoaiDanhMuc;
use App\ChiTietUserThamGiaUpcode;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
class DmLinkQuanTriController extends Controller
{

    public function dmLinkQuanTri(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;

        // danh sách đơn vị để đưa qua view render ra
        $donVis=DonVi::select('don_vi.id', 'don_vi.ten_don_vi', 'don_vi.dia_chi', 'don_vi.co_dinh', 'don_vi.fax', 'don_vi.di_dong', 'don_vi.parent', 'don_vi.state')
        ->get()->toArray();

        $loaiDanhMucs=LoaiDanhMuc::all()->toArray();


        return view('admin.dm-link-quan-tri.dm-link-quan-tri',compact('donVis', 'loaiDanhMucs'));
    }

    public function loadDmLinkQuanTri(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $dmLinkQuanTris=DmLinkQuanTri::select('dm_link_quan_tri.id', 'dm_link_quan_tri.link', 'dm_link_quan_tri.ten_link', 'dm_link_quan_tri.mo_ta', 'dm_link_quan_tri.state', 'users.name', 'dm_link_quan_tri.id_loai_danh_muc', 'loai_danh_muc.ten_loai_danh_muc')
        ->leftJoin('users','dm_link_quan_tri.id_users','=','users.id')
        ->leftJoin('users_don_vi','dm_link_quan_tri.id_users','=','users_don_vi.id_users')
        ->leftJoin('loai_danh_muc','dm_link_quan_tri.id_loai_danh_muc','=','loai_danh_muc.id')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get()->toArray();
        $view=view('admin.dm-link-quan-tri.load-dm-link-quan-tri', compact('dmLinkQuanTris'))->render();             
        return response()->json(['html'=>$view]);

    }
    public function themDmLinkQuanTri(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id_users']=$idUser;
            $data['id']=null;
            // nếu chưa có thêm vô
            DmLinkQuanTri::create($data);
            return array('error'=>0);
        }
        return array('error'=>1);
    }


    public function xoaDmLinkQuanTri(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $dmLinkQuanTri=DmLinkQuanTri::where('id','=',RequestAjax::get('id'))->where('id_users','=',$idUser)->get()->toArray();
            if(count($dmLinkQuanTri)){
                $dmLinkQuanTri=DmLinkQuanTri::findOrFail(RequestAjax::get('id'));
                $dmLinkQuanTri->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền xóa dữ liệu này.');
            }
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
        
    }


    public function suaDmLinkQuanTri(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id_users']=$idUser;
            // kiểm tra
            $id=RequestAjax::get('id');
            $check=DmLinkQuanTri::where('id','=',$id)->where('id_users','=',$idUser)->get()->toArray();
            if(count($check)>0){ // nếu có
                $dmLinkQuanTri=DmLinkQuanTri::findOrFail($id);
                $dmLinkQuanTri->update($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền sửa dữ liệu này.');
            }
        }
        return array('error'=>1);
    }


    public function getDmLinkQuanTriById(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $dmLinkQuanTri=DmLinkQuanTri::findOrFail($id);
            $dmLinkQuanTri['error']=0;
            return $dmLinkQuanTri;
        }
    }
    
}
