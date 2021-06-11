<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;

use App\GiaoViecCongViec;
use App\GiaoViecMucDo;
use App\GiaoViecLoaiXuLy;
use App\GiaoViecUserCongViec;
use App\GiaoViecXuLy;





use App\GVMucDo;
use App\GvCongViec;
use App\GvXuLy;
use App\GvUserXuLy;
use App\User;
use App\UserDonVi;
use App\DonVi;
use App\BaoCaoNghiBu;
use App\ChiTietUpcode;
use App\PhanCong;
class GiaoViecController extends Controller
{
    private $pathFile='public/file/cong-viec';
    public function lanhDaoTaoCongViecV2(){
        $idUser=Auth::user()->id;
        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get();
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $loaiDanhMucs=PhanCong::select('loai_danh_muc.id','loai_danh_muc.ten_loai_danh_muc')
        ->leftJoin('loai_danh_muc','phan_cong.id_loai_danh_muc','loai_danh_muc.id')
        ->where('phan_cong.id_user','=',$idUser)
        ->get();

        return view('admin.giao-viec.giao-viec-lanh-dao-tao-cong-viec',compact('mucDos','loaiDanhMucs'));
    }
    public function nhanVienTaoCongViecV2(){
        $idUser=Auth::user()->id;
        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get();
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $loaiDanhMucs=PhanCong::select('loai_danh_muc.id','loai_danh_muc.ten_loai_danh_muc')
        ->leftJoin('loai_danh_muc','phan_cong.id_loai_danh_muc','loai_danh_muc.id')
        ->where('phan_cong.id_user','=',$idUser)
        ->get();

        return view('admin.giao-viec.giao-viec-nhan-vien-tao-cong-viec',compact('mucDos','loaiDanhMucs'));
    }

    public function taoCongViecV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $file='';
            if ($request->hasFile('tai_lieu_cong_viec')) {
                $fileNameSave='';
                foreach ($request->file('tai_lieu_cong_viec') as $key => $file) {
                    $fileName=time().$key.'_'.$file->getClientOriginalName();
                    $fileNameSave.=$fileName.';';
                    $path = $file->storeAs($this->pathFile, $fileName);
                }
                $file=$fileNameSave;
                
            }
            $data['tai_lieu_cong_viec']=$file;



            $data['id_user_tao']=$idUser;
            $data['ngay_gio_tao']=date("Y-m-d H:i:s");
            $congViec=GiaoViecCongViec::create($data);
            if($data['ma_cong_viec']==''){
                $congViec->ma_cong_viec=$congViec->id;                
            }
            $congViec->sap_xep=$congViec->id;
            $congViec->update();

            // lưu lại lịch xử tạo
            $dataGiaoViecXuLy['id_cong_viec']=$congViec->id;
            $dataGiaoViecXuLy['id_user_xu_ly']=$idUser;
            $dataGiaoViecXuLy['id_loai_xu_ly']=$data['id_loai_xu_ly'];
            $dataGiaoViecXuLy['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $dataGiaoViecXuLy['noi_dung_xu_ly']=$data['noi_dung_cong_viec'];
            $dataGiaoViecXuLy['file_xu_ly']=$file;
            $giaoViecXuLy=GiaoViecXuLy::create($dataGiaoViecXuLy);

            
            
            return array('error'=>0);
        }
        return array('error'=>1);
    }


    public function lanhDaoGiaoCongViecV2(){
        $idUser=Auth::user()->id;
        
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 
        return view('admin.giao-viec.giao-viec-lanh-dao-giao-cong-viec',compact('mucDos'));
    }

    public function loadDsCongViecCanGiaoV2(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        // ten_nguoi_xu_ly cũng chính là tên người tạo task
        $dsCongViecs=DB::select('select t3.id, t3.id_xu_ly, t4.ma_cong_viec, t4.ten_cong_viec, t4.noi_dung_cong_viec, t4.ghi_chu_cong_viec,
            t4.tai_lieu_cong_viec, t4.han_xu_ly_cong_viec, t4.id_muc_do_cong_viec, t5.id_loai_xu_ly, t5.trang_thai as trang_thai_xu_ly, t5.ngay_gio_xu_ly, t7.ten_don_vi, t8.name as ten_nguoi_xu_ly, t8.di_dong
            from 
                (   select t2.id, max(t1.id) as id_xu_ly from giao_viec_xu_ly t1
                    left join giao_viec_cong_viec t2 on t1.id_cong_viec=t2.id
                    group by t2.id
                ) as t3
            left join giao_viec_cong_viec as t4 on t3.id=t4.id
            left join giao_viec_xu_ly as t5 on t3.id_xu_ly=t5.id
            left join users_don_vi as t6 on t4.id_user_tao=t6.id_users
            left join don_vi as t7 on t6.id_don_vi=t7.id
            left join users as t8 on t5.id_user_xu_ly=t8.id
            where (t5.id_loai_xu_ly=1 or t5.id_loai_xu_ly=2) and t6.id_don_vi='.$idDonVi
        );
        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 

        $users=User::select('users.id','users.name')
        ->leftJoin('users_don_vi','users.id','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get();






        $donVis1=DonVi::select('don_vi.id', 'don_vi.ten_don_vi', 'don_vi.parent')
        ->get()->toArray(); 
        // chú ý nếu như không lấy được user vào trong đơn vị có thể user đó có đơn vị gốc là đơn vị khác
        $userXuLy=User::select('users.name as ten_don_vi', 'users_don_vi.id_don_vi as parent', 'users.id as id')
        ->join('users_don_vi','users.id','=','users_don_vi.id_users')
        ->where('users.id_don_vi','=',$idDonViGoc)
        ->get()->toArray();
        $users1=array();
        foreach ($userXuLy as $key => $user) {
            $user['id']='userId:'.$user['id'];
            $users1[]=$user;
        }
        $donVis = array_merge($users1, $donVis1);





        $view=view('admin.giao-viec.giao-viec-load-ds-cong-viec-can-giao', compact('dsCongViecs', 'mucDos', 'users', 'donVis', 'idDonVi'))->render();             
        return response()->json(['html'=>$view]);

    }

    public function loadCayXuLyCongViecV2(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $idCongViec=RequestAjax::get('id');
        // cập nhật lại trạng thái đã xem cho task
        $capNhatTrangThaiDaXem=$this->capNhatTrangThai($idCongViec, 1);

        $dsXuLys=GiaoViecXuLy::select('users.name', 'giao_viec_xu_ly.id_user_xu_ly', 'giao_viec_loai_xu_ly.ten_loai_xu_ly', 'giao_viec_xu_ly.id_loai_xu_ly', 'giao_viec_xu_ly.ngay_gio_xu_ly', 'giao_viec_xu_ly.noi_dung_xu_ly', 'giao_viec_xu_ly.file_xu_ly', 'giao_viec_xu_ly.trang_thai as trang_thai_xu_ly', 'giao_viec_xu_ly.id_cong_viec','giao_viec_loai_xu_ly.ten_buoc_ke', 'giao_viec_cong_viec.han_xu_ly_cong_viec')
        ->leftJoin('users','giao_viec_xu_ly.id_user_xu_ly','users.id')
        ->leftJoin('giao_viec_loai_xu_ly','giao_viec_xu_ly.id_loai_xu_ly','giao_viec_loai_xu_ly.id')
        ->leftJoin('giao_viec_cong_viec','giao_viec_xu_ly.id_cong_viec','giao_viec_cong_viec.id')
        ->where('giao_viec_xu_ly.id_cong_viec','=',$idCongViec)
        ->orderBy('giao_viec_xu_ly.id','desc')
        ->get();
        $view=view('admin.giao-viec.giao-viec-load-cay-xu-ly-cong-viec', compact('dsXuLys'))->render();             
        return response()->json(['html'=>$view]);

    }

    public function xoaCongViecV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $countCongViec=GiaoViecCongViec::where('id','=',RequestAjax::get('id'))->where('id_user_tao','=',$idUser)->count();
            if($countCongViec>0){
                $congViec=GiaoViecCongViec::findOrFail(RequestAjax::get('id'));
                $congViec->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không thể xóa dữ liệu này!');
            }
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
        
    }

    public function getChiTietCongViecV2(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $congViec=GiaoViecCongViec::select('giao_viec_cong_viec.id', 'giao_viec_cong_viec.id_muc_do_cong_viec', 'giao_viec_cong_viec.ma_cong_viec', 'giao_viec_cong_viec.ten_cong_viec', 'giao_viec_cong_viec.noi_dung_cong_viec', 'giao_viec_cong_viec.ghi_chu_cong_viec', 'giao_viec_cong_viec.tai_lieu_cong_viec', 'giao_viec_cong_viec.han_xu_ly_cong_viec', 'giao_viec_cong_viec.ngay_gio_tao', 'giao_viec_cong_viec.sap_xep')
            ->leftJoin('giao_viec_muc_do','giao_viec_cong_viec.id_muc_do_cong_viec','giao_viec_muc_do.id')
            ->leftJoin('users','giao_viec_cong_viec.id_user_tao','users.id')
            ->where('giao_viec_cong_viec.id','=',$id)->get()->toArray();
            if(count($congViec)>0){
                $congViec[0]['error']=0;
                return $congViec[0];
            }
            else{
                return array('error'=>'Không tìm thấy công việc cần xem!');
            }
            
        }
        return array('error'=>'Vui lòng liên hệ quản trị!');
    }

    

    public function loadDsUserXuLyCongViecV2(){
        $idCongViec=RequestAjax::get('id');
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';
        $dsUserXuLys=GiaoViecUserCongViec::select('giao_viec_user_cong_viec.id','giao_viec_user_cong_viec.trang_thai', 'users.name', 'giao_viec_user_cong_viec.xu_ly')
        ->leftJoin('users','giao_viec_user_cong_viec.id_user_thuc_hien','users.id')
        ->where('giao_viec_user_cong_viec.id_cong_viec','=',$idCongViec)
        ->orderBy('giao_viec_user_cong_viec.trang_thai','desc')
        ->get()->toArray();
        
        $view=view('admin.giao-viec.giao-viec-load-ds-user-xu-ly-cong-viec', compact('dsUserXuLys'))->render();             
        return response()->json(['html'=>$view]);

    }

    public function loadDsUserXuLyCongViec2V2(){
        $idCongViec=RequestAjax::get('id');
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';
        $dsUserXuLys=GiaoViecUserCongViec::select('giao_viec_user_cong_viec.id','giao_viec_user_cong_viec.trang_thai', 'users.name', 'giao_viec_user_cong_viec.id_user_thuc_hien')
        ->leftJoin('users','giao_viec_user_cong_viec.id_user_thuc_hien','users.id')
        ->where('giao_viec_user_cong_viec.id_cong_viec','=',$idCongViec)
        ->orderBy('giao_viec_user_cong_viec.trang_thai','desc')
        ->get()->toArray();
        
        return array('error'=>0, 'data'=>$dsUserXuLys);

    }


    
    public function themUserXuLyV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            
            $data=RequestAjax::all();
            unset($data['id']);
            $data['id_user_giao']=$idUser;
            if(RequestAjax::get('trang_thai')==1){
                GiaoViecUserCongViec::where('id_cong_viec','=',RequestAjax::get('id_cong_viec'))->where('trang_thai','=',RequestAjax::get('trang_thai'))->delete();
            }

            // check tồn tại trước khi thêm
            $userCongViecs=GiaoViecUserCongViec::where('id_cong_viec','=',RequestAjax::get('id_cong_viec'))->where('id_user_thuc_hien','=',RequestAjax::get('id_user_thuc_hien'))->get()->count();
            if($userCongViecs<=0){
                $userCongViec=GiaoViecUserCongViec::create($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Cán bộ xử lý đã tồn tại');
            }


            
            
        }
        return array('error'=>1);
    }

    
    public function xoaUserXuLyCongViecV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $userCongViecs=GiaoViecUserCongViec::where('id','=',RequestAjax::get('id'))->where('id_user_giao','=',$idUser)->get()->count();
            if($userCongViecs>0){
                $userCongViecs=GiaoViecUserCongViec::findOrFail(RequestAjax::get('id'));
                $userCongViecs->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không thể xóa dữ liệu này!');
            }
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
        
    }

    public function xoaUserXuLyCongViec2V2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $userCongViecs=GiaoViecUserCongViec::where('id_cong_viec','=',RequestAjax::get('id_cong_viec'))->where('id_user_giao','=',$idUser)->where('id_user_thuc_hien','=',RequestAjax::get('id_user_thuc_hien'))->where('trang_thai','=',RequestAjax::get('trang_thai'))->get();
            if(count($userCongViecs)>0){
                $id=$userCongViecs[0]->id;
                $userCongViecs=GiaoViecUserCongViec::findOrFail($id);
                $userCongViecs->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không thể xóa dữ liệu này!');
            }
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
        
    }

    
    public function themGiaoViecXuLyV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            
            $data=RequestAjax::all();
            unset($data['id']);
            $checkPhanCong=GiaoViecUserCongViec::where('id_cong_viec','=',$data['id_cong_viec'])->get()->count();
            if($checkPhanCong<=0){
                return array('error'=>'Bạn chưa phân công cán bộ xử lý!');
            }
            $congViec=GiaoViecCongViec::findOrFail($data['id_cong_viec']);
            $noiDungXuLy='';
            $fileXuLy='';
            if($congViec){
                $noiDungXuLy=$congViec->noi_dung_cong_viec;
                $fileXuLy=$congViec->tai_lieu_cong_viec;
                $congViec->han_xu_ly_cong_viec=$data['han_xu_ly_cong_viec'];
                $congViec->id_muc_do_cong_viec=$data['id_muc_do_cong_viec'];
                $congViec->update();
            }

            $capNhatTrangThai=$this->capNhatTrangThai($data['id_cong_viec'], 2);
                

            $data['id_user_xu_ly']=$idUser;
            $data['id_loai_xu_ly']=3;
            $data['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $data['noi_dung_xu_ly']=$noiDungXuLy;
            $data['file_xu_ly']=$fileXuLy;
            $data['trang_thai']=0;

            $userCongViec=GiaoViecXuLy::create($data);
            return array('error'=>0);
        }
        return array('error'=>1);
    }


    public function xuLyCongViecV2(){
        $idUser=Auth::user()->id;
        
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 
        return view('admin.giao-viec.giao-viec-xu-ly-cong-viec',compact('mucDos'));
    }

    
    public function loadDsCongViecCanXuLyV2(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $dsCongViecs=DB::select('select t3.id, t3.id_xu_ly, t4.ma_cong_viec, t4.ten_cong_viec, t4.noi_dung_cong_viec, t4.ghi_chu_cong_viec, t4.ngay_gio_tao,
            t4.tai_lieu_cong_viec, t4.han_xu_ly_cong_viec, t4.id_muc_do_cong_viec, t5.id_loai_xu_ly, t5.trang_thai as trang_thai_xu_ly, t7.trang_thai as la_xu_ly_chinh, t7.xu_ly
            from 
                (   select t2.id, max(t1.id) as id_xu_ly from giao_viec_xu_ly t1
                    left join giao_viec_cong_viec t2 on t1.id_cong_viec=t2.id
                    group by t2.id
                ) as t3
            left join giao_viec_cong_viec as t4 on t3.id=t4.id
            left join giao_viec_xu_ly as t5 on t3.id_xu_ly=t5.id
            left join users_don_vi as t6 on t4.id_user_tao=t6.id_users
            left join giao_viec_user_cong_viec as t7 on t3.id=t7.id_cong_viec
            where (t5.id_loai_xu_ly=3 or t5.id_loai_xu_ly=7) and t7.id_user_thuc_hien='.$idUser
        );
        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 

        $users=User::select('users.id','users.name')
        ->leftJoin('users_don_vi','users.id','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get();
        $view=view('admin.giao-viec.giao-viec-load-ds-cong-viec-can-xu-ly', compact('dsCongViecs', 'mucDos', 'users'))->render();             
        return response()->json(['html'=>$view]);

    }


    public function chuyenLanhDaoHoTroCongViecV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $data=RequestAjax::all();
            unset($data['id']);
            $data['id_user_xu_ly']=$idUser;
            $data['id_loai_xu_ly']=4;
            $data['noi_dung_xu_ly']=$data['noi_dung_yeu_cau'];
            $data['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $file='';
            if ($request->hasFile('file_xu_ly')) {
                $fileNameSave='';
                foreach ($request->file('file_xu_ly') as $key => $file) {
                    $fileName=time().$key.'_'.$file->getClientOriginalName();
                    $fileNameSave.=$fileName.';';
                    $path = $file->storeAs($this->pathFile, $fileName);
                }
                $file=$fileNameSave;                
            }
            $data['file_xu_ly']=$file;
            // cập nhật lại trạng thái đã xem cho task
            $capNhatTrangThaiDaXem=$this->capNhatTrangThai($data['id_cong_viec'], 2);

            $userCongViec=GiaoViecXuLy::create($data);
            return array('error'=>0);
        }
        return array('error'=>1);
    }
    public function chuyenLanhDaoDuyetCongViecV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $data=RequestAjax::all();
            // Kiểm tra các thành viên đã xử lý xong hết chưa
            $idCongViec=RequestAjax::get('id_cong_viec');
            $userXuLys=GiaoViecUserCongViec::where('id_cong_viec','=',$idCongViec)->where('trang_thai','=',0)->get();
            $daXuLy=1;
            foreach ($userXuLys as $key => $userXuLy) {
                if($userXuLy->xu_ly==0){
                    $daXuLy=0;
                }
            }
            if($daXuLy==0){
                return array('error'=>'Có một hoặc nhiều thành viên chưa xử lý nên bạn không thể hoàn tất công việc.');
            }
            $userXuLys=GiaoViecUserCongViec::where('id_cong_viec','=',$idCongViec)->where('trang_thai','=',1)->where('id_user_thuc_hien','=',$idUser)->get();
            if(count($userXuLys)>0){
                $userXuLy=$userXuLys[0];
                $userXuLy->xu_ly=1;
                $userXuLy->update();
            }



            unset($data['id']);
            $data['id_user_xu_ly']=$idUser;
            $data['id_loai_xu_ly']=5;
            $data['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $file='';
            if ($request->hasFile('file_xu_ly')) {
                $fileNameSave='';
                foreach ($request->file('file_xu_ly') as $key => $file) {
                    $fileName=time().$key.'_'.$file->getClientOriginalName();
                    $fileNameSave.=$fileName.';';
                    $path = $file->storeAs($this->pathFile, $fileName);
                }
                $file=$fileNameSave;                
            }
            $data['file_xu_ly']=$file;
            // cập nhật lại trạng thái đã xem cho task
            $capNhatTrangThaiDaXem=$this->capNhatTrangThai($data['id_cong_viec'], 2);

            $userCongViec=GiaoViecXuLy::create($data);
            return array('error'=>0);
        }
        return array('error'=>1);
    }


    
    public function lanhDaoHoTroXuLy(){
        $idUser=Auth::user()->id;
        
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 
        return view('admin.giao-viec.giao-viec-lanh-dao-ho-tro-xu-ly',compact('mucDos'));
    }

    public function loadDsCongViecCanLanhDaoHoTroV2(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $dsCongViecs=DB::select('select t3.id, t3.id_xu_ly, t4.ma_cong_viec, t4.ten_cong_viec, t4.noi_dung_cong_viec, t4.ghi_chu_cong_viec, t4.ngay_gio_tao,
            t4.tai_lieu_cong_viec, t4.han_xu_ly_cong_viec, t4.id_muc_do_cong_viec, t5.id_loai_xu_ly, t5.trang_thai as trang_thai_xu_ly
            from 
                (   select t2.id, max(t1.id) as id_xu_ly from giao_viec_xu_ly t1
                    left join giao_viec_cong_viec t2 on t1.id_cong_viec=t2.id
                    group by t2.id
                ) as t3
            left join giao_viec_cong_viec as t4 on t3.id=t4.id
            left join giao_viec_xu_ly as t5 on t3.id_xu_ly=t5.id
            left join users_don_vi as t6 on t4.id_user_tao=t6.id_users
            where t5.id_loai_xu_ly=4 and t6.id_don_vi='.$idDonVi
        );
        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 

        $users=User::select('users.id','users.name')
        ->leftJoin('users_don_vi','users.id','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get();
        $view=view('admin.giao-viec.giao-viec-load-ds-cong-viec-can-lanh-dao-ho-tro-v2', compact('dsCongViecs', 'mucDos', 'users'))->render();             
        return response()->json(['html'=>$view]);

    }

    
    public function phanHoiYeuCauHoTroV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $data=RequestAjax::all();
            unset($data['id']);
            $data['id_user_xu_ly']=$idUser;
            $data['id_loai_xu_ly']=6;
            $data['trang_thai']=2;
            $data['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $file='';
            if ($request->hasFile('file_xu_ly')) {
                $fileNameSave='';
                foreach ($request->file('file_xu_ly') as $key => $file) {
                    $fileName=time().$key.'_'.$file->getClientOriginalName();
                    $fileNameSave.=$fileName.';';
                    $path = $file->storeAs($this->pathFile, $fileName);
                }
                $file=$fileNameSave;                
            }
            $data['file_xu_ly']=$file;
            // cập nhật lại trạng thái đã xem cho task
            $capNhatTrangThaiDaXem=$this->capNhatTrangThai($data['id_cong_viec'], 2);

            // phản hồi yêu cầu hỗ trợ
            $userCongViec=GiaoViecXuLy::create($data);

            // Yêu cầu thực hiện tiếp công việc
            $data2=RequestAjax::all();
            $data2['id_loai_xu_ly']=7;
            $data2['id_user_xu_ly']=$idUser;
            $data2['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $data2['file_xu_ly']='';
            $data2['noi_dung_xu_ly']='A/C tiếp tục xử lý công việc';
            $data2['trang_thai']=2;
            $userCongViec2=GiaoViecXuLy::create($data2);

            if($data['han_xu_ly_cong_viec']!=''){
                $congViec=GiaoViecCongViec::findOrFail($data['id_cong_viec']);
                $congViec->han_xu_ly_cong_viec=$data['han_xu_ly_cong_viec'];
                $congViec->update();
            }
            return array('error'=>0);
        }
        return array('error'=>1);
    }

    public function duyetHoanTatCongViecV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $data=RequestAjax::all();

            // CẬP NHẬT HẠN XỬ LÝ
            $capNhatHanXuLy='';
            if($data['han_xu_ly_cong_viec']!=''){
                $congViec=GiaoViecCongViec::findOrFail($data['id_cong_viec']);
                $congViec->han_xu_ly_cong_viec=$data['han_xu_ly_cong_viec'];
                $congViec->update();
                $capNhatHanXuLy='Cập nhật hạn xử lý, ';
            }


            // cập nhật lại trạng thái đã xem cho task
            $capNhatTrangThaiDaXem=$this->capNhatTrangThai($data['id_cong_viec'], 2);

            unset($data['id']);
            $data['id_user_xu_ly']=$idUser;
            $data['id_loai_xu_ly']=6;
            $data['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $data['noi_dung_xu_ly']=$capNhatHanXuLy.$data['noi_dung_xu_ly'];
            $data['trang_thai']=2;
            $file='';
            if ($request->hasFile('file_xu_ly')) {
                $fileNameSave='';
                foreach ($request->file('file_xu_ly') as $key => $file) {
                    $fileName=time().$key.'_'.$file->getClientOriginalName();
                    $fileNameSave.=$fileName.';';
                    $path = $file->storeAs($this->pathFile, $fileName);
                }
                $file=$fileNameSave;                
            }
            $data['file_xu_ly']=$file;
            // phản hồi yêu cầu hỗ trợ
            $userCongViec=GiaoViecXuLy::create($data);

            // Duyệt hoàn tất công việc
            $data2=RequestAjax::all();
            $data2['id_loai_xu_ly']=9;
            $data2['id_user_xu_ly']=$idUser;
            $data2['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $data2['file_xu_ly']=$file;
            $data2['trang_thai']=2;
            $data2['noi_dung_xu_ly']=$capNhatHanXuLy.'Duyệt hoàn tất công việc';
            $userCongViec2=GiaoViecXuLy::create($data2);

            
            return array('error'=>0);
        }
        return array('error'=>1);
    }



    public function lanhDaoDuyetCongViec(){
        $idUser=Auth::user()->id;
        
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 
        return view('admin.giao-viec.giao-viec-lanh-dao-duyet',compact('mucDos'));
    }

    public function loadDsCongViecCanLanhDaoDuyetV2(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $dsCongViecs=DB::select('select t3.id, t3.id_xu_ly, t4.ma_cong_viec, t4.ten_cong_viec, t4.noi_dung_cong_viec, t4.ghi_chu_cong_viec, t4.ngay_gio_tao,
            t4.tai_lieu_cong_viec, t4.han_xu_ly_cong_viec, t4.id_muc_do_cong_viec, t5.id_loai_xu_ly, t5.trang_thai as trang_thai_xu_ly
            from 
                (   select t2.id, max(t1.id) as id_xu_ly from giao_viec_xu_ly t1
                    left join giao_viec_cong_viec t2 on t1.id_cong_viec=t2.id
                    group by t2.id
                ) as t3
            left join giao_viec_cong_viec as t4 on t3.id=t4.id
            left join giao_viec_xu_ly as t5 on t3.id_xu_ly=t5.id
            left join users_don_vi as t6 on t4.id_user_tao=t6.id_users
            where t5.id_loai_xu_ly=5 and t6.id_don_vi='.$idDonVi
        );
        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 

        $users=User::select('users.id','users.name')
        ->leftJoin('users_don_vi','users.id','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get();
        $view=view('admin.giao-viec.giao-viec-load-ds-cong-viec-can-lanh-dao-duyet-v2', compact('dsCongViecs', 'mucDos', 'users'))->render();             
        return response()->json(['html'=>$view]);

    }

    
    public function phanHoiYeuCauDuyetV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $data=RequestAjax::all();
            unset($data['id']);
            $data['id_user_xu_ly']=$idUser;
            $data['id_loai_xu_ly']=8;
            $data['trang_thai']=2;
            $data['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $file='';
            if ($request->hasFile('file_xu_ly')) {
                $fileNameSave='';
                foreach ($request->file('file_xu_ly') as $key => $file) {
                    $fileName=time().$key.'_'.$file->getClientOriginalName();
                    $fileNameSave.=$fileName.';';
                    $path = $file->storeAs($this->pathFile, $fileName);
                }
                $file=$fileNameSave;                
            }
            $data['file_xu_ly']=$file;
            // cập nhật lại trạng thái đã xem cho task
            $capNhatTrangThaiDaXem=$this->capNhatTrangThai($data['id_cong_viec'], 2);
            // phản hồi yêu cầu duyệt
            $userCongViec=GiaoViecXuLy::create($data);

            // Yêu cầu thực hiện tiếp công việc
            $data2=RequestAjax::all();
            $data2['id_loai_xu_ly']=7;
            $data2['id_user_xu_ly']=$idUser;
            $data2['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $data2['file_xu_ly']=$file;
            $data2['trang_thai']=0;
            $userCongViec2=GiaoViecXuLy::create($data2);
            return array('error'=>0);
        }
        return array('error'=>1);
    }

    public function dongYDuyetCongViecV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $data=RequestAjax::all();

            // cập nhật lại trạng thái đã xem cho task
            $capNhatTrangThaiDaXem=$this->capNhatTrangThai($data['id_cong_viec'], 2);
            unset($data['id']);
            $data['id_user_xu_ly']=$idUser;
            $data['id_loai_xu_ly']=9;
            $data['trang_thai']=2;
            $data['ngay_gio_xu_ly']=date("Y-m-d H:i:s");
            $file='';
            if ($request->hasFile('file_xu_ly')) {
                $fileNameSave='';
                foreach ($request->file('file_xu_ly') as $key => $file) {
                    $fileName=time().$key.'_'.$file->getClientOriginalName();
                    $fileNameSave.=$fileName.';';
                    $path = $file->storeAs($this->pathFile, $fileName);
                }
                $file=$fileNameSave;                
            }
            $data['file_xu_ly']=$file;
            // phản hồi yêu cầu hỗ trợ
            $userCongViec=GiaoViecXuLy::create($data);
            
            return array('error'=>0);
        }
        return array('error'=>1);
    }





    public function danhSachCongViecDaDuyetV2(){
        $idUser=Auth::user()->id;
        
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 
        return view('admin.giao-viec.giao-viec-danh-sach-cong-viec-da-duyet',compact('mucDos'));
    }

    public function loadDanhSachCongViecDaDuyetV2(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $dsCongViecs=DB::select('select t3.id, t3.id_xu_ly, t4.ma_cong_viec, t4.ten_cong_viec, t4.noi_dung_cong_viec, t4.ghi_chu_cong_viec, t4.ngay_gio_tao,
            t4.tai_lieu_cong_viec, t4.han_xu_ly_cong_viec, t4.id_muc_do_cong_viec, t5.id_loai_xu_ly, t5.trang_thai as trang_thai_xu_ly
            from 
                (   select t2.id, max(t1.id) as id_xu_ly from giao_viec_xu_ly t1
                    left join giao_viec_cong_viec t2 on t1.id_cong_viec=t2.id
                    group by t2.id
                ) as t3
            left join giao_viec_cong_viec as t4 on t3.id=t4.id
            left join giao_viec_xu_ly as t5 on t3.id_xu_ly=t5.id
            left join users_don_vi as t6 on t4.id_user_tao=t6.id_users
            where t5.id_loai_xu_ly=9 and t6.id_don_vi='.$idDonVi
        );
        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 

        $users=User::select('users.id','users.name')
        ->leftJoin('users_don_vi','users.id','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get();
        $view=view('admin.giao-viec.giao-viec-load-danh-sach-cong-viec-da-duyet', compact('dsCongViecs', 'mucDos', 'users'))->render();             
        return response()->json(['html'=>$view]);

    }



    public function tatCaCongViecV2(){
        $idUser=Auth::user()->id;
        
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 
        return view('admin.giao-viec.giao-viec-tat-ca-cong-viec-v2',compact('mucDos'));
    }

    public function loadTatCaCongViecV2(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $dsCongViecs=DB::select('select t3.id, t3.id_xu_ly, t4.ma_cong_viec, t4.ten_cong_viec, t4.noi_dung_cong_viec, t4.ghi_chu_cong_viec, t4.ngay_gio_tao,
            t4.tai_lieu_cong_viec, t4.han_xu_ly_cong_viec, t4.id_muc_do_cong_viec, t5.id_loai_xu_ly, t5.trang_thai as trang_thai_xu_ly, t7.ten_loai_xu_ly
            from 
                (   select t2.id, max(t1.id) as id_xu_ly from giao_viec_xu_ly t1
                    left join giao_viec_cong_viec t2 on t1.id_cong_viec=t2.id
                    group by t2.id
                ) as t3
            left join giao_viec_cong_viec as t4 on t3.id=t4.id
            left join giao_viec_xu_ly as t5 on t3.id_xu_ly=t5.id
            left join users_don_vi as t6 on t4.id_user_tao=t6.id_users
            left join giao_viec_loai_xu_ly as t7 on t5.id_loai_xu_ly=t7.id
            where t6.id_don_vi='.$idDonVi
        );
        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 

        $users=User::select('users.id','users.name')
        ->leftJoin('users_don_vi','users.id','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get();
        $view=view('admin.giao-viec.giao-viec-load-tat-ca-cong-viec-v2', compact('dsCongViecs', 'mucDos', 'users'))->render();             
        return response()->json(['html'=>$view]);

    }


    
    public function downloadTaiLieuCongViecV2(Request $request)
    {
        $id=$request->id;
        $stt=$request->stt;
        $congViec=GiaoViecCongViec::findOrFail($id);
        $taiLieus=explode(';', $congViec->tai_lieu_cong_viec);
        $stt2=0;
        $tenFile='';
        foreach ($taiLieus as $key => $value) {
            $stt2++;
            if($stt2==$stt){
                $tenFile=$value;
            }

        }
        
        $file = storage_path('app/public/file/cong-viec/'.$tenFile);
        return response()->file($file);
    }


    /*
        0: mặc định là chưa xem
        1: đã xem
        2: đã xử lý
        ***********Lưu ý**** Phải cập nhật trước khi chuyển bước
    */
    public function capNhatTrangThai($idCongViec, $trangThai){
        $idUser=Auth::user()->id;
        $checkUserXuLy=GiaoViecUserCongViec::where('id_user_thuc_hien','=',$idUser)->where('id_cong_viec','=',$idCongViec)->count();
        $congViec=DB::select('select t2.id, max(t1.id) as id_xu_ly from giao_viec_xu_ly t1
            left join giao_viec_cong_viec t2 on t1.id_cong_viec=t2.id
            where t2.id='.$idCongViec.'
            group by t2.id'
        );
        if(count($congViec)>0){
            $idXuLy=$congViec[0]->id_xu_ly;
            $xuLy=GiaoViecXuLy::findOrFail($idXuLy);
            if($xuLy->id_loai_xu_ly<3){
                $xuLy->trang_thai=$trangThai;
                $xuLy->update();
                return array('error'=>0);
            }
                
        }
        if(count($congViec)>0 && $checkUserXuLy>0){
            $idXuLy=$congViec[0]->id_xu_ly;
            $xuLy=GiaoViecXuLy::findOrFail($idXuLy);
            $xuLy->trang_thai=$trangThai;
            $xuLy->update();
            return array('error'=>0);
        }
        return array('error'=>'Không cập nhật trạng thái');

    }


    public function baoCaoHoanTatCongViecV2(Request $request){
        $idUser=Auth::user()->id;
        $idCongViec=RequestAjax::get('id_cong_viec');
        $userXuLys=GiaoViecUserCongViec::where('id_cong_viec','=',$idCongViec)->where('id_user_thuc_hien','=',$idUser)->get();
        if(count($userXuLys)>0){
            $userXuLy=$userXuLys[0];
            $xuLy=$userXuLy->xu_ly;
            if($xuLy==1){
                $userXuLy->xu_ly=0;
            }else{
                $userXuLy->xu_ly=1;
            }
            $userXuLy->update();
            return array('error'=>0);
        }
        return array('error'=>'Không tồn tại công việc cần xử lý!');

    }

    


    public function danhSachCongViecDaGiaoV2(){
        $idUser=Auth::user()->id;
        
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 
        return view('admin.giao-viec.giao-viec-danh-sach-cong-viec-da-giao',compact('mucDos'));
    }


    
    public function loadDsCongViecDaGiaoV2(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        // ten_nguoi_xu_ly cũng chính là tên người tạo task
        $dsCongViecs=DB::select('select t4.id, t5.id as id_xu_ly, t4.ma_cong_viec, t4.ten_cong_viec, t4.noi_dung_cong_viec, t4.ghi_chu_cong_viec, t4.ngay_gio_tao,
            t4.tai_lieu_cong_viec, t4.han_xu_ly_cong_viec, t4.id_muc_do_cong_viec, t5.id_loai_xu_ly, t5.trang_thai as trang_thai_xu_ly, t5.ngay_gio_xu_ly, t7.ten_don_vi, t8.name as ten_nguoi_xu_ly, t8.di_dong
            from giao_viec_cong_viec as t4
            left join giao_viec_xu_ly as t5 on t4.id=t5.id_cong_viec
            left join users_don_vi as t6 on t4.id_user_tao=t6.id_users
            left join don_vi as t7 on t6.id_don_vi=t7.id
            left join users as t8 on t5.id_user_xu_ly=t8.id
            where t5.id_loai_xu_ly=3 and t5.id_user_xu_ly='.$idUser
        );
        $mucDos=GiaoViecMucDo::where('trang_thai','=',1)->get(); 

        $users=User::select('users.id','users.name')
        ->leftJoin('users_don_vi','users.id','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get();






        $donVis1=DonVi::select('don_vi.id', 'don_vi.ten_don_vi', 'don_vi.parent')
        ->get()->toArray(); 
        // chú ý nếu như không lấy được user vào trong đơn vị có thể user đó có đơn vị gốc là đơn vị khác
        $userXuLy=User::select('users.name as ten_don_vi', 'users_don_vi.id_don_vi as parent', 'users.id as id')
        ->join('users_don_vi','users.id','=','users_don_vi.id_users')
        ->where('users.id_don_vi','=',$idDonViGoc)
        ->get()->toArray();
        $users1=array();
        foreach ($userXuLy as $key => $user) {
            $user['id']='userId:'.$user['id'];
            $users1[]=$user;
        }
        $donVis = array_merge($users1, $donVis1);





        $view=view('admin.giao-viec.giao-viec-load-ds-cong-viec-da-giao', compact('dsCongViecs', 'mucDos', 'users', 'donVis', 'idDonVi'))->render();             
        return response()->json(['html'=>$view]);

    }


    
    public function capNhatGiaoViecXuLyV2(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            
            $data=RequestAjax::all();
            unset($data['id']);
            $congViec=GiaoViecCongViec::findOrFail($data['id_cong_viec']);
            if($congViec){
                $congViec->han_xu_ly_cong_viec=$data['han_xu_ly_cong_viec'];
                $congViec->id_muc_do_cong_viec=$data['id_muc_do_cong_viec'];
                $congViec->update();
                return array('error'=>0);
            }
            return array('error'=>"Không tìm thấy công việc cần cập nhật");
            
        }
        return array('error'=>1);
    }
    

    





















































    /*public function congViecLanhDao(){
        $idUser=Auth::user()->id;
        $mucDos=GvMucDo::all();
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $users=User::select('users_don_vi.id_users','users.name')
        ->leftJoin('users_don_vi','users.id','users_don_vi.id_users')
        ->where('users_don_vi.id_don_vi','=',$idDonVi)
        ->get();

        return view('admin.giao-viec.cong-viec-lanh-dao',compact('mucDos','users'));
    }

    public function loadCongViecLanhDao(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $idDonVi='';

        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        $dsCongViecs=GvCongViec::select('gv_cong_viec.id', 'gv_cong_viec.ten_cong_viec','gv_cong_viec.han_xu_ly_chinh','gv_cong_viec.ngay_gio_hoan_thanh_chinh','gv_cong_viec.user_tao', 'users.name', 'gv_cong_viec.state')
        ->leftJoin('users','gv_cong_viec.user_tao','=','users.id')
        ->orderBy('gv_cong_viec.sap_xep')
        ->get()->toArray();


        $dsXuLys=array();
        $dsUserXuLys=array();
        foreach ($dsCongViecs as $key => $congViec) {
            $dsXL=GvXuLy::select('gv_xu_ly.id', 'gv_xu_ly.id_cong_viec', 'gv_xu_ly.noi_dung', 'gv_xu_ly.ngay_gio_giao', 'gv_xu_ly.han_xu_ly', 'gv_xu_ly.state', 'gv_loai_xu_ly.ten_loai_xu_ly', 'gv_xu_ly.id_loai_xu_ly', 'gv_xu_ly.ngay_gio_hoan_thanh')
            ->leftJoin('gv_loai_xu_ly','gv_xu_ly.id_loai_xu_ly','gv_loai_xu_ly.id')
            ->where('id_cong_viec','=',$congViec['id'])->get()->toArray();
            if(count($dsXL)>0){
                $dsXuLys[$congViec['id']]=$dsXL;
                if(count($dsXL)>0){
                    foreach ($dsXL as $key => $xuLy) {
                        if(count($xuLy)>0){
                            $ghiChu='';
                            $userXuLyChinh=GvUserXuLy::select('users.name','gv_user_xu_ly.id')
                            ->leftJoin('users','gv_user_xu_ly.id_user_xu_ly','=','users.id')
                            ->where('gv_user_xu_ly.id_xu_ly','=',$xuLy['id'])
                            ->where('gv_user_xu_ly.state','=',1)->get()->toArray();
                            if(count($userXuLyChinh)>0){
                                $ghiChu='<span class="text-warning">'.$userXuLyChinh[0]['name'].' - Xử lý chính </span>';
                            }
                            $soLuongUserXuLy=GvUserXuLy::where('id_xu_ly','=',$xuLy['id'])->count();
                            if($soLuongUserXuLy>0){
                                if($ghiChu!=''){
                                    $ghiChu.='<span class="text-warning"> +'.$soLuongUserXuLy.' người khác phối hợp xử lý.</span>';
                                }
                                else{
                                    if($soLuongUserXuLy==1){
                                        $motUserXuLy=GvUserXuLy::select('users.name')->where('gv_user_xu_ly.id_xu_ly','=',$xuLy['id'])->leftJoin('users','gv_user_xu_ly.id_user_xu_ly','=','users.id')->get()->toArray();
                                        $ghiChu.='<span class="text-warning">'.$motUserXuLy[0]['name'].' - phối hợp xử lý.</span>';
                                    }else{
                                        $ghiChu.='<span class="text-warning">Có '.$soLuongUserXuLy.' ngườ phối hợp xử lý.</span>';
                                    }
                                    
                                }
                            }                            
                            $dsUserXuLys[$xuLy['id']]=$ghiChu;
                        }
                            
                    }
                }
            }
        }

        $view=view('admin.giao-viec.load-cong-viec-lanh-dao', compact('dsCongViecs', 'dsXuLys', 'dsUserXuLys'))->render();             
        return response()->json(['html'=>$view]);

    }*/

    public function congViecNhanVien(){
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

        return view('admin.giao-viec.tao-cong-viec',compact('donVis', 'idDonVi','lichUpcodes'));
    }

    public function loadCongViecNhanVien(){
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


    public function taoCongViec(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            unset($data['id']);
            $data['user_tao']=$idUser;

            $dsCongViecs=GvCongViec::all();
            $count=$dsCongViecs->count();
            $data['ma_cong_viec']=0000+$count;
            $data['ngay_gio_tao']=date("Y-m-d H:i:s");

            $congViec=GvCongViec::create($data);
            return array('error'=>0);
        }
        return array('error'=>1);
    }


    public function xoaCongViec(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $congViec=GvCongViec::where('id','=',RequestAjax::get('id'))->where('user_tao','=',$idUser)->get()->toArray();
            if(count($congViec)>0){
                $congViec=GvCongViec::findOrFail(RequestAjax::get('id'));
                $congViec->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không thể xóa dữ liệu này!');
            }
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
        
    }


    public function suaCongViec(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            // kiểm tra
            $id=RequestAjax::get('id');
            $check=GvCongViec::where('id','=',$id)->where('user_tao','=',$idUser)->get()->toArray();
            $check2=GvCongViec::where('id','=',$id)->where('user_duyet','=',$idUser)->get()->toArray();
            
            if(count($check)>0 || count($check2)>0){ // nếu có
                $congViec=GvCongViec::find($id);
                $congViec->update($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền sửa dữ liệu này.');
            }
        }
        return array('error'=>1);
    }


    

    public function getCongViecById(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $congViec=GvCongViec::find($id);
            $congViec['error']=0;
            return $congViec;
        }
        return array('error'=>'Vui lòng liên hệ quản trị!');
    }

    public function taoXuLy(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            unset($data['id']);
            $data['ngay_gio_giao']=date("Y-m-d H:i:s");
            

            $congViec=GvXuLy::create($data);
            return array('error'=>0);
        }
        return array('error'=>1);
    }



    public function getNoiDungXuLyById(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $xuLy=GvXuLy::find($id);
            $xuLy['error']=0;
            return $xuLy;
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
    }

    public function suaXuLy(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id']=RequestAjax::get('id_xu_ly');
            

            $xuLy=GvXuLy::findOrFail(RequestAjax::get('id_xu_ly'));
            $xuLy->update($data);
            return array('error'=>0);
        }
        return array('error'=>1);
    }

    public function xoaXuLy(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $countXuLy=GvXuLy::leftJoin('gv_cong_viec', 'gv_xu_ly.id_cong_viec','=','gv_cong_viec.id')
            ->where('gv_xu_ly.id','=',RequestAjax::get('id'))->where('gv_cong_viec.user_tao','=',$idUser)->count();
            if($countXuLy>0){
                $xuLy=GvXuLy::findOrFail(RequestAjax::get('id'));
                $xuLy->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không thể xóa dữ liệu này!');
            }
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
        
    }


    

    public function themCanBoXuLy(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            unset($data['id']);
            $data['id_xu_ly']=$data['id_xu_ly2'];
            $data['id_user_giao']=$idUser;
            $data['state']=$data['state_user_xu_ly'];
            
            

            $congViec=GvUserXuLy::create($data);
            return array('error'=>0);
        }
        return array('error'=>1);
    }

    public function xoaCanBoXuLy(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $countXuLy=GvUserXuLy::where('id','=',RequestAjax::get('id'))->where('id_user_giao','=',$idUser)->count();
            if($countXuLy>0){
                $xuLy=GvUserXuLy::findOrFail(RequestAjax::get('id'));
                $xuLy->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không thể xóa dữ liệu này, chỉ người tạo mới được xóa!');
            }
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
        
    }


}