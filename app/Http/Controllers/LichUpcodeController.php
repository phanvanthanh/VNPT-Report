<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\LichUpcode;
use App\UserDonVi;
use App\User;
use App\ChiTietUpcode;
use App\ChiTietUserThamGiaUpcode;
use App\DanhMucLoi;
use App\LoaiDanhMuc;
use App\BaoCaoNghiBu;
use DB;
use Auth;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
use DateTime;
class LichUpcodeController extends Controller
{

    public function lichUpcode(){
        $idUser=Auth::user()->id;
        $loaiDanhMucs=LoaiDanhMuc::all()->toArray();

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

        $danhMucLois=array();


        return view('admin.lich-upcode.lich-upcode', compact('danhMucLois','dsUsers', 'loaiDanhMucs'));
    }

    public function loadDanhMucLoi(Request $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $idLichUpcode=RequestAjax::get('id_lich_upcode');
            // lấy id loại danh mục theo id lịch upcode
            $lichUpcode=LichUpcode::find($idLichUpcode);
            $idLoaiDanhMuc=$lichUpcode->id_loai_danh_muc;
            // get danh sách danh mục lỗi 1: của chính user này tạo
            $danhMucLoi1=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.ma_yeu_cau', 'dm_loi.loai')
            ->join('users','dm_loi.id_user','=','users.id')
            ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
            ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
            ->where('dm_loi.id_user','=',$idUser)
            ->where('dm_loi.id_loai_danh_muc','=',$idLoaiDanhMuc)
            ->get()->toArray();

            // get danh sách danh mục lỗi 2: của người khác share cho đơn vị sử dụng
            // 1. Phải biết user này đang ở chính xác đơn vị nào
            // 2. Lấy danh sách danh mục lỗi theo đơn vị được share
            $donViOfUsers=UserDonVi::where('id_users','=',$idUser)->get()->toArray(); // lấy id đơn vị của user này
            $idDonViOfUser='';
            if(count($donViOfUsers)>0){
                $idDonViOfUser=$donViOfUsers[0]['id_don_vi'];
            }

            $danhMucLoi2=array();
            if($idDonViOfUser){
                $danhMucLoi2=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.ma_yeu_cau', 'dm_loi.loai')        
                ->join('users','dm_loi.id_user','=','users.id')
                ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
                ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
                ->where('dm_loi.id_user','!=',$idUser)->where('dm_loi.ds_don_vi_duoc_chia_se','like','%'.$idDonViOfUser.'%')
                ->where('dm_loi.id_loai_danh_muc','=',$idLoaiDanhMuc)
                ->get()->toArray();
            }

            $danhMucLois = array_merge($danhMucLoi1, $danhMucLoi2);
            $danhMucLois['error']=0;
            $view=view('admin.lich-upcode.load-danh-muc-loi', compact('danhMucLois'))->render();             
            return response()->json(['html'=>$view]);
        }        
    }

    public function taoLichUpcode(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $data=RequestAjax::all();
            $data['id_users']=$idUser;
            $data['state']=0;
            LichUpcode::create($data);
            return array('error'=>0);
        }        
    }

    public function suaLichUpcode(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $idLichUpcode=RequestAjax::get('id');
            $checkLichUpcode=LichUpcode::where('id','=',$idLichUpcode)->where('id_users','=',$idUser)->get()->toArray();
            if(count($checkLichUpcode)>0){
                $data=RequestAjax::all();
                $data['id_users']=$idUser;

                // check báo bù có được duyệt chưa, nếu có 1 cái đã duyệt rồi thì không sửa được lịch nữa
                $checkBaoBus=BaoCaoNghiBu::where('id_lich_upcode','=',$idLichUpcode)->where('state','!=',0)->get()->toArray();
                if(count($checkBaoBus)>0){
                    return array('error'=>'Lịch đã hoàn thành và đã được sắp sếp nghỉ bù nên không thể chỉnh sửa. <br>Vui lòng kiểm tra lại!');
                }
                
                // cập nhật lại thông tin lịch upcode
                $lichUpcode=LichUpcode::findOrFail(RequestAjax::get('id'));
                $lichUpcode->update($data);

                // Xóa mấy thằng báo bù, để cập nhật lại
                $updateBaoBus=BaoCaoNghiBu::where('id_lich_upcode','=',$idLichUpcode)->delete();

                // khoảng thời gian nghỉ bù
                $date1 = new DateTime($lichUpcode->thoi_gian_bat_dau);
                $date2 = new DateTime($lichUpcode->thoi_gian_ket_thuc);
                $diff = $date2->diff($date1);
                $hours = $diff->h;
                $soGio = $hours + ($diff->days*24) + ($diff->i/60);

                // lấy chi tiết upcode ra để biết id user rồi cập nhật vào bảng báo bù
                $chiTietUpcodes=ChiTietUpcode::select('id_users')->distinct()
                ->where('id_lich_upcode','=',$idLichUpcode)->get()->toArray();
                foreach ($chiTietUpcodes as $key => $chiTietUpcode) {
                    $data['id_users']=$chiTietUpcode['id_users'];
                    $data['id_lich_upcode']=$idLichUpcode;
                    $data['noi_dung_nghi_bu']='Xin nghỉ bù theo lịch upcode: '.$lichUpcode->ten_lich_upcode;
                    $data['ds_tai_khoan_duoc_chia_se']='';
                    $data['thoi_gian_yeu_cau_nghi_bu']=$soGio; // sửa thời gian lại
                    $data['state']=0;
                    $data['id']=null;
                    $baoCaoNghiBu=new BaoCaoNghiBu();
                    $baoCaoNghiBu->create($data);
                }
                
                return array('error'=>0);
            }
                
            return array('error'=>'Vui lòng liên hệ quản trị!');
        }        
    }

    public function xoaLichUpcode(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $checkLichUpcode=LichUpcode::where('id','=',RequestAjax::get('id'))->where('id_users','=',$idUser)->get()->toArray();
            if(count($checkLichUpcode)>0){
                $lichUpcode=LichUpcode::findOrFail(RequestAjax::get('id'));
                $lichUpcode->delete();
                return array('error'=>0);
            }
                
            return array('error'=>1);
        }        
    }
    public function loadLichUpcode(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
            // lấy lịch là lấy của toàn viễn thông ra (Công khai lịch)
            if(count($userDonVis)>0){
                $idDonVi=$userDonVis[0]['id_don_vi'];
                $dsLichs=LichUpcode::select('users.name','lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'lich_upcode.so_luong_nhan_su_tham_gia', 'lich_upcode.state', 'lich_upcode.id', 'loai_danh_muc.ten_loai_danh_muc')
                ->where('users_don_vi.id_don_vi','=',$idDonVi)
                ->join('users','lich_upcode.id_users','=','users.id')
                ->leftJoin('loai_danh_muc','lich_upcode.id_loai_danh_muc','=','loai_danh_muc.id')
                ->join('users_don_vi','users.id','=','users_don_vi.id_users')
                ->get()->toArray();
                return $dsLichs;
            }else{
                return array('error'=>1);
            }                
        }        
    }

    public function getLichUpcodeById(RequestAjax $request){
        if(RequestAjax::ajax()){

            $idUser=Auth::user()->id;
            $lichUpcode=LichUpcode::where('id','=',RequestAjax::get('id'))->where('id_users','=',$idUser)->get()->toArray();
            if(count($lichUpcode)>0){
                // lấy lịch upcode chi tiết của 1 lịch
                $lichUpcode[0]['error']=0;
                return $lichUpcode[0];
            }
            return array('error'=>'Lịch cần sửa của bạn không tồn tại / Không thể sửa lịch của user khác');
        }        
    }
    public function loadChiTietUpcode(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idLichUpcode=RequestAjax::get('id');
            $chiTietUpcodes=ChiTietUpcode::select('chi_tiet_upcode.id','chi_tiet_upcode.id_lich_upcode', 'dm_loi.ten_dm_loi', 'chi_tiet_upcode.id_dm_loi', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_users', 'users.name', 'chi_tiet_upcode.ghi_chu')
            ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
            ->leftJoin('users','chi_tiet_upcode.id_users','=','users.id')
            ->where('chi_tiet_upcode.id_lich_upcode','=',$idLichUpcode)
            ->get()->toArray();
            $view=view('admin.lich-upcode.load-chi-tiet-lich-upcode', compact('chiTietUpcodes'))->render();             
            return response()->json(['html'=>$view]);
        }        
    }
    public function themChiTietUpcode(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            // kiểm tra lịch này của ai tạo nếu của người khác tạo mới cho thêm
            $checkLichUpcode=LichUpcode::where('id','=',RequestAjax::get('id_lich_upcode'))->where('id_users','=',$idUser)->get()->toArray();
            if(count($checkLichUpcode)<=0){
                return array('error'=>'Lỗi, Bạn không có quyền cấu hình lịch này.');
            }
            if($checkLichUpcode[0]['state']==1){
                return array('error'=>'Lỗi, Không thể cập nhật thêm, vì lịch này đã cấu hình hoàn thành!');
            }
            // check dữ liệu đã tồn tại chưa
            $chiTietUpcodes=ChiTietUpcode::where('id_dm_loi','=',RequestAjax::get('id_dm_loi'))->where('id_lich_upcode','=',RequestAjax::get('id_lich_upcode'))->where('id_users','=',RequestAjax::get('id_users'))->get()->toArray();
            if(count($chiTietUpcodes)>0){
                return array('error'=>'Dữ liệu này đã tồn tại.');
            }
            // nếu chưa tồn tại thì thêm vô
            $data=RequestAjax::all();
            $data['tinh_trang']=0;
            ChiTietUpcode::create($data);
            return array('error'=>0);
        }else{
            return array('error'=>1);
        }  
    }
    public function xoaChiTietUpcode(RequestAjax $request){
        if(RequestAjax::ajax()){
            // kiểm tra trước
            $idUser=Auth::user()->id;
            $chiTietUpcode=ChiTietUpcode::findOrFail(RequestAjax::get('id'));
            $idLichUpcode=$chiTietUpcode->id_lich_upcode;
            $check=LichUpcode::where('id','=',$idLichUpcode)->where('id_users','=',$idUser)->get()->toArray();
            if(count($check)>0){
                $chiTietUpcode->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không thể xóa chi tiết upcode do người khác phân công!');
            }   
        }      
        else{
            return array('error'=>1);
        }        
    }


    public function suaTrangThaiChiTietUpcode(RequestAjax $request){
        if(RequestAjax::ajax()){
            $chiTietUpcode=ChiTietUpcode::findOrFail(RequestAjax::get('id_chi_tiet_upcode'));
            $chiTietUpcode->tinh_trang=RequestAjax::get('tinh_trang');
            $chiTietUpcode->save();
            return array('error'=>0);
        }      
        else{
            return array('error'=>1);
        }      
    }



    public function lichUpcodeCaNhan(){
        $idUser=Auth::user()->id;
        $tuan=date('W');
        $nam=date('Y');
        return view('admin.lich-upcode.lich-upcode-ca-nhan', compact('tuan', 'nam'));
    }


    public function loadLichUpcodeCaNhan(){
        $idUser=Auth::user()->id;
        // DANH SÁCH LỖI
        // get danh sách danh mục lỗi 1: của chính user này tạo
        $danhMucLoi1=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.ma_yeu_cau', 'dm_loi.loai')
        ->join('users','dm_loi.id_user','=','users.id')
        ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
        ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
        ->where('dm_loi.id_user','=',$idUser)
        ->get()->toArray();

        // get danh sách danh mục lỗi 2: của người khác share cho đơn vị sử dụng
        // 1. Phải biết user này đang ở chính xác đơn vị nào
        // 2. Lấy danh sách danh mục lỗi theo đơn vị được share
        $donViOfUsers=UserDonVi::where('id_users','=',$idUser)->get()->toArray(); // lấy id đơn vị của user này
        $idDonViOfUser='';
        if(count($donViOfUsers)>0){
            $idDonViOfUser=$donViOfUsers[0]['id_don_vi'];
        }

        $danhMucLoi2=array();
        if($idDonViOfUser){
            $danhMucLoi2=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.ma_yeu_cau', 'dm_loi.loai')        
            ->join('users','dm_loi.id_user','=','users.id')
            ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
            ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
            ->where('dm_loi.id_user','!=',$idUser)->where('dm_loi.ds_don_vi_duoc_chia_se','like','%'.$idDonViOfUser.'%')
            ->get()->toArray();
        }

        $danhMucLois = array_merge($danhMucLoi1, $danhMucLoi2);

        // END DANH SÁCH LỖI
        $tuan=date('W');
        $nam=date('Y');
        if(RequestAjax::get('tuan')){
            $tuan=RequestAjax::get('tuan');
        }
        if(RequestAjax::get('nam')){
            $nam=RequestAjax::get('nam');
        }

        $dto = new \DateTime();
        $ret['Thứ 2'] = $dto->setISODate($nam, $tuan)->format('Y-m-d');
        $ret['Thứ 3'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['Thứ 4'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['Thứ 5'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['Thứ 6'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['Thứ 7'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['Thứ 8'] = $dto->modify('+1 days')->format('Y-m-d');

        
        // lấy lịch upcode thu2
        $ctLichUpcodes_thu2=ChiTietUpcode::select('chi_tiet_upcode.id', 'chi_tiet_upcode.id_lich_upcode', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_dm_loi', 'dm_loi.ten_dm_loi', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'chi_tiet_upcode.ghi_chu', 'users.name', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'lich_upcode.state')
        ->leftJoin('lich_upcode','chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('users','lich_upcode.id_users','=','users.id')
        ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
        ->where('lich_upcode.thoi_gian_bat_dau_du_kien','like', $ret['Thứ 2'].'%')
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->get()->toArray();
        $ctUpcodeThu2s=array();
        foreach ($ctLichUpcodes_thu2 as $key => $ctLichUpcode_thu2) {
            $ctUpcodeThu2s[$ctLichUpcode_thu2['id_lich_upcode']][]=$ctLichUpcode_thu2;
        }

        // lấy lịch upcode thu3
        $ctLichUpcodes_thu3=ChiTietUpcode::select('chi_tiet_upcode.id', 'chi_tiet_upcode.id_lich_upcode', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_dm_loi', 'dm_loi.ten_dm_loi', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'chi_tiet_upcode.ghi_chu', 'users.name', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'lich_upcode.state')
        ->leftJoin('lich_upcode','chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('users','lich_upcode.id_users','=','users.id')
        ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
        ->where('lich_upcode.thoi_gian_bat_dau_du_kien','like', $ret['Thứ 3'].'%')
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->get()->toArray();
        $ctUpcodeThu3s=array();
        foreach ($ctLichUpcodes_thu3 as $key => $ctLichUpcode_thu3) {
            $ctUpcodeThu3s[$ctLichUpcode_thu3['id_lich_upcode']][]=$ctLichUpcode_thu3;
        }


        // lấy lịch upcode thu4
        $ctLichUpcodes_thu4=ChiTietUpcode::select('chi_tiet_upcode.id', 'chi_tiet_upcode.id_lich_upcode', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_dm_loi', 'dm_loi.ten_dm_loi', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'chi_tiet_upcode.ghi_chu', 'users.name', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'lich_upcode.state')
        ->leftJoin('lich_upcode','chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('users','lich_upcode.id_users','=','users.id')
        ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
        ->where('lich_upcode.thoi_gian_bat_dau_du_kien','like', $ret['Thứ 4'].'%')
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->get()->toArray();
        $ctUpcodeThu4s=array();
        foreach ($ctLichUpcodes_thu4 as $key => $ctLichUpcode_thu4) {
            $ctUpcodeThu4s[$ctLichUpcode_thu4['id_lich_upcode']][]=$ctLichUpcode_thu4;
        }


        // lấy lịch upcode thu5
        $ctLichUpcodes_thu5=ChiTietUpcode::select('chi_tiet_upcode.id', 'chi_tiet_upcode.id_lich_upcode', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_dm_loi', 'dm_loi.ten_dm_loi', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'chi_tiet_upcode.ghi_chu', 'users.name', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'lich_upcode.state')
        ->leftJoin('lich_upcode','chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('users','lich_upcode.id_users','=','users.id')
        ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
        ->where('lich_upcode.thoi_gian_bat_dau_du_kien','like', $ret['Thứ 5'].'%')
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->get()->toArray();
        $ctUpcodeThu5s=array();
        foreach ($ctLichUpcodes_thu5 as $key => $ctLichUpcode_thu5) {
            $ctUpcodeThu5s[$ctLichUpcode_thu5['id_lich_upcode']][]=$ctLichUpcode_thu5;
        }


        // lấy lịch upcode thu6
        $ctLichUpcodes_thu6=ChiTietUpcode::select('chi_tiet_upcode.id', 'chi_tiet_upcode.id_lich_upcode', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_dm_loi', 'dm_loi.ten_dm_loi', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'chi_tiet_upcode.ghi_chu', 'users.name', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'lich_upcode.state')
        ->leftJoin('lich_upcode','chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('users','lich_upcode.id_users','=','users.id')
        ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
        ->where('lich_upcode.thoi_gian_bat_dau_du_kien','like', $ret['Thứ 6'].'%')
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->get()->toArray();
        $ctUpcodeThu6s=array();
        foreach ($ctLichUpcodes_thu6 as $key => $ctLichUpcode_thu6) {
            $ctUpcodeThu6s[$ctLichUpcode_thu6['id_lich_upcode']][]=$ctLichUpcode_thu6;
        }


        // lấy lịch upcode thu7
        $ctLichUpcodes_thu7=ChiTietUpcode::select('chi_tiet_upcode.id', 'chi_tiet_upcode.id_lich_upcode', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_dm_loi', 'dm_loi.ten_dm_loi', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'chi_tiet_upcode.ghi_chu', 'users.name', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'lich_upcode.state')
        ->leftJoin('lich_upcode','chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('users','lich_upcode.id_users','=','users.id')
        ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
        ->where('lich_upcode.thoi_gian_bat_dau_du_kien','like', $ret['Thứ 7'].'%')
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->get()->toArray();
        $ctUpcodeThu7s=array();
        foreach ($ctLichUpcodes_thu7 as $key => $ctLichUpcode_thu7) {
            $ctUpcodeThu7s[$ctLichUpcode_thu7['id_lich_upcode']][]=$ctLichUpcode_thu7;
        }

        // lấy lịch upcode thu8
        $ctLichUpcodes_thu8=ChiTietUpcode::select('chi_tiet_upcode.id', 'chi_tiet_upcode.id_lich_upcode', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_dm_loi', 'dm_loi.ten_dm_loi', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'chi_tiet_upcode.ghi_chu', 'users.name', 'lich_upcode.thoi_gian_bat_dau', 'lich_upcode.thoi_gian_ket_thuc', 'lich_upcode.state')
        ->leftJoin('lich_upcode','chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('users','lich_upcode.id_users','=','users.id')
        ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
        ->where('lich_upcode.thoi_gian_bat_dau_du_kien','like', $ret['Thứ 8'].'%')
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->get()->toArray();
        $ctUpcodeThu8s=array();
        foreach ($ctLichUpcodes_thu8 as $key => $ctLichUpcode_thu8) {
            $ctUpcodeThu8s[$ctLichUpcode_thu8['id_lich_upcode']][]=$ctLichUpcode_thu8;
        }

        
        $view=view('admin.lich-upcode.load-lich-upcode-ca-nhan', compact('ret','tuan', 'nam', 'ctUpcodeThu2s', 'ctUpcodeThu3s', 'ctUpcodeThu4s', 'ctUpcodeThu5s', 'ctUpcodeThu6s', 'ctUpcodeThu7s', 'ctUpcodeThu8s', 'danhMucLois'))->render();             
        return response()->json(['html'=>$view]);

    }

    public function loadChiTietUpcodeCaNhan(){
        $idUser=Auth::user()->id;
        $idLichUpcode=RequestAjax::get('id_lich_upcode');
        $chiTietUpcodes=ChiTietUpcode::select('chi_tiet_upcode.id', 'chi_tiet_upcode.id_lich_upcode', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_dm_loi', 'dm_loi.ten_dm_loi', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'chi_tiet_upcode.ghi_chu')
        ->leftJoin('lich_upcode','chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
        ->where('lich_upcode.id','=', $idLichUpcode)
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->get()->toArray();
        
        $view=view('admin.lich-upcode.load-chi-tiet-lich-upcode-ca-nhan', compact('chiTietUpcodes'))->render();             
        return response()->json(['html'=>$view]);
    }


    public function themChiTietUpcodeCaNhan(Request $request){
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            // check dữ liệu đã tồn tại chưa
            $chiTietUpcodes=ChiTietUpcode::where('id_dm_loi','=',RequestAjax::get('id_dm_loi'))->where('id_lich_upcode','=',RequestAjax::get('id_lich_upcode'))->where('id_users','=',RequestAjax::get('id_users'))->get()->toArray();
            if(count($chiTietUpcodes)>0){
                return array('error'=>'Dữ liệu này đã tồn tại.');
            }
            // nếu chưa tồn tại thì thêm vô
            $data=RequestAjax::all();
            ChiTietUpcode::create($data);
            return array('error'=>0);
        }else{
            return array('error'=>1);
        }  
    }


    public function loadChiTietUpcodeCaNhanById(){
        $idUser=Auth::user()->id;
        $idChiTietUpcode=RequestAjax::get('id');
        $chiTietUpcodes=ChiTietUpcode::select('chi_tiet_upcode.id', 'chi_tiet_upcode.id_lich_upcode', 'chi_tiet_upcode.tinh_trang', 'chi_tiet_upcode.id_dm_loi', 'dm_loi.ten_dm_loi', 'lich_upcode.ten_lich_upcode', 'lich_upcode.thoi_gian_bat_dau_du_kien', 'lich_upcode.thoi_gian_ket_thuc_du_kien', 'chi_tiet_upcode.ghi_chu')
        ->leftJoin('lich_upcode','chi_tiet_upcode.id_lich_upcode','=','lich_upcode.id')
        ->leftJoin('dm_loi','chi_tiet_upcode.id_dm_loi','=','dm_loi.id')
        ->where('chi_tiet_upcode.id','=', $idChiTietUpcode)
        ->where('chi_tiet_upcode.id_users','=',$idUser)
        ->get()->toArray();
        $chiTietUpcodes=$chiTietUpcodes[0];
        $chiTietUpcodes['error']=0;
        return $chiTietUpcodes;
    }


    public function suaChiTietUpcodeCaNhanById(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $id=RequestAjax::get('id_chi_tiet_lich_upcode');
            $data=RequestAjax::all();
            // kiểm tra
            $check=ChiTietUpcode::where('id','=',$id)->where('id_users','=',$idUser)->get()->toArray();
            
            if(count($check)>0){ // nếu có
                $chiTietUpcode=ChiTietUpcode::find($id);
                unset($data['id_users']);
                unset($data['id_dm_loi']);
                $chiTietUpcode->update($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền sửa dữ liệu này.');
            }
        }
        return array('error'=>1);
    }
    
}
