<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\LoaiDanhMuc;
use App\DanhMucLoi;
use App\UserDonVi;
use App\ThongTinHoTro;
use App\DmDonViYeuCau;
use DB;
use Auth;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
class HoTroController extends Controller
{

    public function congTacHoTro(){
        $idDonVi=Auth::user()->id_don_vi;
        $loaiDanhMucs=LoaiDanhMuc::where('state','=',1)->get()->toArray();

        $dmDonViYeuCaus=DmDonViYeuCau::select('dm_don_vi_yeu_cau.id','dm_don_vi_yeu_cau.ten_don_vi')
        ->join('users','dm_don_vi_yeu_cau.id_users','=','users.id')
        ->where('dm_don_vi_yeu_cau.state','=',1)->where('users.id_don_vi','=',$idDonVi)
        ->get()->toArray();

        $tuan=date('W');
        $nam=date('Y');

        $dto = new \DateTime();
        $ret['2'] = $dto->setISODate($nam, $tuan)->format('Y-m-d');
        $ret['3'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['4'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['5'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['6'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['7'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['8'] = $dto->modify('+1 days')->format('Y-m-d');

        return view('admin.ho-tro.cong-tac-ho-tro',compact('loaiDanhMucs','dmDonViYeuCaus', 'tuan', 'nam', 'ret'));
    }

    public function getTuan(RequestAjax $request){
        $tuan=date('W');
        $nam=date('Y');
        if(RequestAjax::get('tuan')){
            $tuan=RequestAjax::get('tuan');
        }
        if(RequestAjax::get('nam')){
            $nam=RequestAjax::get('nam');
        }

        $dto = new \DateTime();
        $ret['2'] = $dto->setISODate($nam, $tuan)->format('Y-m-d');
        $ret['3'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['4'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['5'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['6'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['7'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['8'] = $dto->modify('+1 days')->format('Y-m-d');

        $arr=array('tuan'=>$tuan, 'nam'=>$nam, 'ret'=>$ret);

        return $arr;
    }

    public function getDanhMucLoiTheoLoaiDanhMuc(RequestAjax $request){
        if(RequestAjax::ajax()){

            $idUser=Auth::user()->id;
            $idLoaiDanhMuc=RequestAjax::get('id_loai_danh_muc');
            // get danh sách danh mục lỗi 1: của chính user này tạo
            $danhMucLoi1=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state')
            ->join('users','dm_loi.id_user','=','users.id')
            ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
            ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
            ->where('dm_loi.id_user','=',$idUser)->where('dm_loi.id_loai_danh_muc','=',$idLoaiDanhMuc)
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
            // nếu id đơn vị user
            if($idDonViOfUser){
                $danhMucLoi2=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state')        
                ->join('users','dm_loi.id_user','=','users.id')
                ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
                ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
                ->where('dm_loi.id_user','!=',$idUser)->where('dm_loi.ds_don_vi_duoc_chia_se','like','%'.$idDonViOfUser.'%')->where('dm_loi.id_loai_danh_muc','=',$idLoaiDanhMuc)
                ->get()->toArray();
            }

            // merge 2 danh mục lại với nhau
            $danhMucLois = array_merge($danhMucLoi1, $danhMucLoi2);

            return $danhMucLois;
        }
        
    }   

    public function getCongTacHoTro(RequestAjax $request){
        if(RequestAjax::ajax()){

            $idUser=Auth::user()->id;
            $idLoaiDanhMuc=RequestAjax::get('id_loai_danh_muc');
            $tuNgay=RequestAjax::get('tu_ngay');
            $denNgay=RequestAjax::get('den_ngay');

            $thongTinHoTros=DB::select('select thong_tin_ho_tro.*, dm_don_vi_yeu_cau.ten_don_vi, dm_loi.ten_dm_loi from `thong_tin_ho_tro` 
            inner join `dm_loi` on `thong_tin_ho_tro`.`id_dm_loi` = `dm_loi`.`id` 
            inner join `dm_don_vi_yeu_cau` on `thong_tin_ho_tro`.`id_dm_don_vi_yeu_cau` = `dm_don_vi_yeu_cau`.`id` 
            where date(`thong_tin_ho_tro`.`ngay_ho_tro`) >= "'.$tuNgay.'"
            and date(`thong_tin_ho_tro`.`ngay_ho_tro`) <= "'.$denNgay.'"
            and `dm_loi`.`id_loai_danh_muc` = '.$idLoaiDanhMuc.' and thong_tin_ho_tro.id_users='.$idUser);



            return $thongTinHoTros;
        }
        
    }   

    public function themThongTinHoTro(RequestAjax $request){
        if(RequestAjax::ajax()){

            $idUser=Auth::user()->id;
            $idDanhMucLoi=RequestAjax::get('id_dm_loi');
            $idDmDonViYeuCau=RequestAjax::get('id_dm_don_vi_yeu_cau');
            $ngayHoTro=RequestAjax::get('ngay_ho_tro');

            // check trước nếu đã tồn tại cùng ngày, cùng lỗi, cùng đơn vị thì => tăng số lượng lên
            $checkThongTinHoTro=ThongTinHoTro::where('id_users','=',$idUser)->where('id_dm_loi','=',$idDanhMucLoi)->where('id_dm_don_vi_yeu_cau','=',$idDmDonViYeuCau)->where('ngay_ho_tro','=',$ngayHoTro)->get();
            if(count($checkThongTinHoTro)>0){
                $checkThongTinHoTro[0]->so_lan_ho_tro=$checkThongTinHoTro[0]->so_lan_ho_tro+1;
                $checkThongTinHoTro[0]->save();
                return array('error'=>0);
            }

            $thongTinHoTro=new ThongTinHoTro();
            $thongTinHoTro->id_users=$idUser;
            $thongTinHoTro->id_dm_loi=$idDanhMucLoi;
            $thongTinHoTro->id_dm_don_vi_yeu_cau=$idDmDonViYeuCau;
            $thongTinHoTro->ngay_ho_tro=$ngayHoTro;
            $thongTinHoTro->so_lan_ho_tro=1;
            $thongTinHoTro->ghi_chu='';
            $thongTinHoTro->state=0;

            $thongTinHoTro->save();


            return array('error'=>0);
        }
        
    } 

    public function xoaThongTinHoTro(){
        $idUser=Auth::user()->id;
        $idThongTinHoTro=RequestAjax::get('id');
        $thongTinHoTro=ThongTinHoTro::where('id','=',$idThongTinHoTro)->where('id_users','=',$idUser)->get()->toArray();
        if(count($thongTinHoTro)>0){
            $thongTinHoTro=ThongTinHoTro::findOrFail($idThongTinHoTro);
            $thongTinHoTro->delete();
            return array('error'=>0);
        }
        return array('error'=>1);
    }




    public function baoCaoCongTacHoTroTuanWord(Request $request){
        $nam=$request->nam;
        $tuan=$request->tuan;
        $idLoaiDanhMuc=$request->dv;
        $loaiDanhMucs=LoaiDanhMuc::find($idLoaiDanhMuc);
        $tenLoaiDanhMuc=$loaiDanhMucs->ten_loai_danh_muc;

        // Báo cáo tuần hiện tại
        $dto = new \DateTime();
        $ret['2'] = $dto->setISODate($nam, $tuan)->format('Y-m-d');
        $ret['3'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['4'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['5'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['6'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['7'] = $dto->modify('+1 days')->format('Y-m-d');
        $ret['8'] = $dto->modify('+1 days')->format('Y-m-d');

        $baoCaoTuNgay=$ret[2];
        $baoCaoDenNgay=$ret[6];

        $tuNgay=$ret[2];
        $denNgay=$ret[8];


        $data=array();
        $idUser=Auth::user()->id;
        $data=DB::select('select thong_tin_ho_tro.*, dm_don_vi_yeu_cau.ten_don_vi, dm_loi.ten_dm_loi from `thong_tin_ho_tro` 
        inner join `dm_loi` on `thong_tin_ho_tro`.`id_dm_loi` = `dm_loi`.`id` 
        inner join `dm_don_vi_yeu_cau` on `thong_tin_ho_tro`.`id_dm_don_vi_yeu_cau` = `dm_don_vi_yeu_cau`.`id` 
        where date(`thong_tin_ho_tro`.`ngay_ho_tro`) >= "'.$tuNgay.'"
        and date(`thong_tin_ho_tro`.`ngay_ho_tro`) <= "'.$denNgay.'"
        and `dm_loi`.`id_loai_danh_muc` = '.$idLoaiDanhMuc.' and thong_tin_ho_tro.id_users='.$idUser);


        // Báo cáo kế hoạch tuần kế tiếp
        $tuan_2=$tuan+1;
        $dto_2 = new \DateTime();
        $ret_2['2'] = $dto_2->setISODate($nam, $tuan_2)->format('Y-m-d');
        $ret_2['3'] = $dto_2->modify('+1 days')->format('Y-m-d');
        $ret_2['4'] = $dto_2->modify('+1 days')->format('Y-m-d');
        $ret_2['5'] = $dto_2->modify('+1 days')->format('Y-m-d');
        $ret_2['6'] = $dto_2->modify('+1 days')->format('Y-m-d');
        $ret_2['7'] = $dto_2->modify('+1 days')->format('Y-m-d');
        $ret_2['8'] = $dto_2->modify('+1 days')->format('Y-m-d');

        $baoCaoTuNgay_2=$ret_2[2];
        $baoCaoDenNgay_2=$ret_2[6];

        $tuNgay_2=$ret_2[2];
        $denNgay_2=$ret_2[8];


        $data_2=array();
        $data_2=DB::select('select thong_tin_ho_tro.*, dm_don_vi_yeu_cau.ten_don_vi, dm_loi.ten_dm_loi from `thong_tin_ho_tro` 
        inner join `dm_loi` on `thong_tin_ho_tro`.`id_dm_loi` = `dm_loi`.`id` 
        inner join `dm_don_vi_yeu_cau` on `thong_tin_ho_tro`.`id_dm_don_vi_yeu_cau` = `dm_don_vi_yeu_cau`.`id` 
        where date(`thong_tin_ho_tro`.`ngay_ho_tro`) >= "'.$tuNgay_2.'"
        and date(`thong_tin_ho_tro`.`ngay_ho_tro`) <= "'.$denNgay_2.'"
        and `dm_loi`.`id_loai_danh_muc` = '.$idLoaiDanhMuc.' and thong_tin_ho_tro.id_users='.$idUser);




        return view('admin.ho-tro.bao-cao-cong-tac-ho-tro-tuan-word',compact('baoCaoTuNgay', 'tuan', 'nam', 'baoCaoDenNgay', 'tuNgay', 'denNgay','tenLoaiDanhMuc', 'data', 'data_2'));
    } 

    
    
}
