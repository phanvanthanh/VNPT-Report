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
use App\DonVi;
use App\BaoCaoNghiBu;
use App\ChiTietUpcode;
class BaoBuController extends Controller
{

    public function baoCaoNghiBu(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;

        // id đơn vị
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        // danh sách đơn vị để đưa qua view render ra
        $donVis=DonVi::select('don_vi.id', 'don_vi.ten_don_vi', 'don_vi.dia_chi', 'don_vi.co_dinh', 'don_vi.fax', 'don_vi.di_dong', 'don_vi.parent', 'don_vi.state')
        ->get()->toArray();

        // danh sách các lịch upcode để báo nghỉ bù
        $lichUpcodes=ChiTietUpcode::select('lich_upcode.id', 'lich_upcode.ten_lich_upcode')
        ->rightJoin('lich_upcode', 'chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->distinct()
        ->get()->toArray();

        return view('admin.bao-cao-nghi-bu.bao-cao-nghi-bu',compact('donVis', 'idDonVi','lichUpcodes'));
    }

    public function loadBaoCaoNghiBu(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $baoCaoNghiBus=BaoCaoNghiBu::select('bao_cao_nghi_bu.id', 'bao_cao_nghi_bu.noi_dung_nghi_bu', 'bao_cao_nghi_bu.id_lich_upcode', 'bao_cao_nghi_bu.state', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'users.name', 'bao_cao_nghi_bu.thoi_gian_yeu_cau_nghi_bu', 'bao_cao_nghi_bu.thoi_gian_duoc_duyet_nghi_bu', 'usd.name as ten_nguoi_duyet')
        ->leftJoin('users','bao_cao_nghi_bu.id_users','=','users.id')
        ->leftJoin('users as usd','bao_cao_nghi_bu.id_users_duyet','=','usd.id')
        ->leftJoin('lich_upcode','bao_cao_nghi_bu.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('users_don_vi','bao_cao_nghi_bu.id_users','=','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get()->toArray();
        $view=view('admin.bao-cao-nghi-bu.load-bao-cao-nghi-bu', compact('baoCaoNghiBus'))->render();             
        return response()->json(['html'=>$view]);

    }
    public function themBaoCaoNghiBu(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id_users']=$idUser;
            $data['id']=null;
            // kiểm tra nếu có đăng ký nghỉ bù rồi thì không được đăng ký lịch đó nữa
            $idLichUpcode=RequestAjax::get('id_lich_upcode');
            $check=BaoCaoNghiBu::where('id_lich_upcode','=',$idLichUpcode)->where('id_users','=',$idUser)->get()->toArray();
            if(count($check)>0){ // nếu đã báo lịch rồi thì không cho báo nữa
                return array('error'=>'Lịch này đã báo bù rồi, không thể báo lại!');
            }
            // nếu chưa có thêm vô
            BaoCaoNghiBu::create($data);
            return array('error'=>0);
        }
        return array('error'=>1);
    }


    public function xoaBaoCaoNghiBu(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $baoCaoNghiBu=BaoCaoNghiBu::where('id','=',RequestAjax::get('id'))->where('id_users','=',$idUser)->where('state','=',0)->get()->toArray();
            if(count($baoCaoNghiBu)>0){
                $baoCaoNghiBu=BaoCaoNghiBu::findOrFail(RequestAjax::get('id'));
                $baoCaoNghiBu->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền xóa dữ liệu đã được duyệt hoặc yêu cầu của user khác.');
            }
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
        
    }


    public function suaBaoCaoNghiBu(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id_users']=$idUser;
            // kiểm tra
            $id=RequestAjax::get('id');
            $check=BaoCaoNghiBu::where('id','=',$id)->where('id_users','=',$idUser)->get()->toArray();
            if(count($check)>0){ // nếu có
                $baoCaoNghiBu=BaoCaoNghiBu::find($id);
                if($baoCaoNghiBu->state==1){
                    return array('error'=>'Lịch đã duyệt không được sửa');
                }
                $baoCaoNghiBu->update($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền sửa dữ liệu này.');
            }
        }
        return array('error'=>1);
    }


    

    public function getBaoCaoNghiBuById(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $baoCaoNghiBu=BaoCaoNghiBu::find($id);
            $baoCaoNghiBu['error']=0;
            return $baoCaoNghiBu;
        }
        return array('error'=>'Vui lòng liên hệ quản trị!');
    }


    public function duyetBaoCaoNghiBu(){
        $idUser=Auth::user()->id;
        return view('admin.bao-cao-nghi-bu.duyet-bao-cao-nghi-bu');
    }

    public function loadDuyetBaoCaoNghiBu(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $baoCaoNghiBus=BaoCaoNghiBu::select('bao_cao_nghi_bu.id', 'bao_cao_nghi_bu.noi_dung_nghi_bu', 'bao_cao_nghi_bu.id_lich_upcode', 'bao_cao_nghi_bu.state', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'users.name', 'bao_cao_nghi_bu.thoi_gian_yeu_cau_nghi_bu', 'bao_cao_nghi_bu.thoi_gian_duoc_duyet_nghi_bu', 'usd.name as ten_nguoi_duyet')
        ->leftJoin('users','bao_cao_nghi_bu.id_users','=','users.id')
        ->leftJoin('users as usd','bao_cao_nghi_bu.id_users_duyet','=','usd.id')
        ->leftJoin('lich_upcode','bao_cao_nghi_bu.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('users_don_vi','bao_cao_nghi_bu.id_users','=','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get()->toArray();
        $view=view('admin.bao-cao-nghi-bu.load-duyet-bao-cao-nghi-bu', compact('baoCaoNghiBus'))->render();             
        return response()->json(['html'=>$view]);

    }

    public function duyetBaoCaoNghiBuById(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $id=RequestAjax::get('id');
            // kiểm tra nếu chưa nghỉ
            $check=BaoCaoNghiBu::where('id','=',$id)->where('state','!=',2)->get()->toArray();
            if(count($check)<=0){
                return array('error'=>'Lỗi, Yêu cầu này đã được duyệt hoặc đã được sử dụng. <br>Vui lòng kiểm tra lại!');
            }
            $thoiGianDuocDuyet=RequestAjax::get('thoi_gian_duoc_duyet_nghi_bu');;
            $state=1;
            if($thoiGianDuocDuyet==0){
                $state=0;
            }
            $baoCaoNghiBu=BaoCaoNghiBu::find($id);
            $baoCaoNghiBu->state=$state;
            $date = date('Y-m-d h:i:s', time());
            $baoCaoNghiBu->ngay_duyet=$date;
            $baoCaoNghiBu->id_users_duyet=$idUser;
            $baoCaoNghiBu->thoi_gian_duoc_duyet_nghi_bu=$thoiGianDuocDuyet;
            $baoCaoNghiBu->save();

            return array('error'=>0);
        }
        return array('error'=>'Vui lòng liên hệ quản trị!');
    }
    
}
