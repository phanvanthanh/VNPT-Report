<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\ThemDMLoiRequest;
use App\DanhMucLoi;
use App\HuongXuLy;
use App\LoaiDanhMuc;
use App\DonVi;
use App\UserDonVi;
use DB;
use Auth;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
class DanhMucLoiController extends Controller
{


    //
    private $pathImg='public/img/dm-loi';
    private $pathFile='public/file/dm-loi';
    public function danhMucLoi(){
        $idUser=Auth::user()->id; 
        $roleId=Auth::user()->role_id;
        $idDonVi=Auth::user()->id_don_vi;

        $huongXuLys=HuongXuLy::all()->toArray();
        $loaiDanhMucs=LoaiDanhMuc::all()->toArray();

        $donVis=DonVi::select('don_vi.id', 'don_vi.ten_don_vi', 'don_vi.dia_chi', 'don_vi.co_dinh', 'don_vi.fax', 'don_vi.di_dong', 'don_vi.parent', 'don_vi.state')
        ->get()->toArray();

        // get danh sách danh mục lỗi 1: của chính user này tạo
        $danhMucLoi1=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.ma_yeu_cau')
        ->join('users','dm_loi.id_user','=','users.id')
        ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
        ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
        ->orderBy('dm_loi.id', 'desc')
        ->where('dm_loi.id_user','=',$idUser)->where('dm_loi.loai','=','LỖI')
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
            $danhMucLoi2=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.ma_yeu_cau')        
            ->join('users','dm_loi.id_user','=','users.id')
            ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
            ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
            ->orderBy('dm_loi.id', 'desc')
            ->where('dm_loi.id_user','!=',$idUser)->where('dm_loi.ds_don_vi_duoc_chia_se','like','%'.$idDonViOfUser.'%')->where('dm_loi.loai','=','LỖI')
            ->get()->toArray();
        }
            
    	return view('admin.danh-muc-loi.danh-muc-loi',compact('loaiDanhMucs', 'huongXuLys', 'donVis', 'danhMucLoi1', 'danhMucLoi2'));
    }

    public function themDanhMucLoi(Request $request){

        $idUser=Auth::user()->id; 
        $roleId=Auth::user()->role_id;
        $idDonVi=Auth::user()->id_don_vi;
        // check tài khoản đăng nhập có tồn tại chưa
        $dmLoi=DanhMucLoi::create([
            'id_user' =>$idUser,
            'ds_don_vi_duoc_chia_se'      => $request->ds_don_vi_duoc_chia_se,
            'ds_tai_khoan_duoc_chia_se'      => $request->ds_tai_khoan_duoc_chia_se,
            'ten_dm_loi'      => $request->ten_dm_loi,
            'link_video_loi'      => $request->link_video_loi,
            'mo_ta'      => $request->mo_ta,
            'yeu_cau'      => $request->yeu_cau,
            'hinh_anh'      => '',
            'file'      => '',
            'cach_khac_phuc'      => $request->cach_khac_phuc,
            'link_video_cach_khac_phuc'      => $request->link_video_cach_khac_phuc,
            'id_huong_xu_ly'      => $request->id_huong_xu_ly,
            'id_loai_danh_muc'      => $request->id_loai_danh_muc,
            'ma_yeu_cau'      => $request->ma_yeu_cau,
            'loai'          => 'LỖI',
            'state'      => 1,
        ]);
        

        if ($request->hasFile('hinh_anh')) {
            $fileNameSave='';
            foreach ($request->file('hinh_anh') as $key => $hinhAnh) {
                $fileName=time().$key.'.'.$hinhAnh->getClientOriginalExtension();
                $fileNameSave.=$fileName.';';
                $path = $hinhAnh->storeAs($this->pathImg, $fileName);
            }
            $dmLoi->hinh_anh=$fileNameSave;
            $dmLoi->save();
            
        }

        if ($request->hasFile('file')) {
            $fileNameSave='';
            foreach ($request->file('file') as $key => $file) {
                $fileName=time().$key.'.'.$file->getClientOriginalExtension();
                $fileNameSave.=$fileName.';';
                $path = $file->storeAs($this->pathFile, $fileName);
            }
            $dmLoi->file=$fileNameSave;
            $dmLoi->save();
            
        }


        return redirect()->intended('/admin/danh-muc-loi');
    }


    
    public function suaDanhMucLoi(Request $request){ 
        $idUser=Auth::user()->id; 
        $roleId=Auth::user()->role_id;
        $idDonVi=Auth::user()->id_don_vi;
        $id=RequestAjax::get('id');
        // check có quyền sửa không
        $dmLoi=DanhMucLoi::where('id_user','=',$idUser)->where('id','=',$id)
            ->get()
            ->toArray();
        if(!$dmLoi){
            return array('error'=>'Bạn chỉ có quyền xem danh mục này!');
        }

        $dmLoi=DanhMucLoi::findOrFail($id);            
        $dmLoi->ds_don_vi_duoc_chia_se=RequestAjax::get('ds_don_vi_duoc_chia_se');
        $dmLoi->ds_tai_khoan_duoc_chia_se=RequestAjax::get('ds_tai_khoan_duoc_chia_se');
        $dmLoi->ten_dm_loi=RequestAjax::get('ten_dm_loi');
        $dmLoi->link_video_loi=RequestAjax::get('link_video_loi');
        $dmLoi->mo_ta=RequestAjax::get('mo_ta');
        $dmLoi->yeu_cau=RequestAjax::get('yeu_cau');
        $dmLoi->cach_khac_phuc=RequestAjax::get('cach_khac_phuc');
        $dmLoi->link_video_cach_khac_phuc=RequestAjax::get('link_video_cach_khac_phuc');
        $dmLoi->id_huong_xu_ly=RequestAjax::get('id_huong_xu_ly');
        $dmLoi->id_loai_danh_muc=RequestAjax::get('id_loai_danh_muc');
        $dmLoi->ma_yeu_cau=RequestAjax::get('ma_yeu_cau');
        $dmLoi->loai='LỖI';
        $dmLoi->save();

        // get file và hình ảnh
        
        /*if (RequestAjax::hasFile('hinh_anh')) {
            $fileNameSave='';
            foreach (RequestAjax::file('hinh_anh') as $key => $hinhAnh) {
                $fileName=time().$key.'.'.$hinhAnh->getClientOriginalExtension();
                $fileNameSave.=$fileName.';';
                $path = $hinhAnh->storeAs($this->pathImg, $fileName);
            }
            $dmLoi->hinh_anh=$fileNameSave;
            $dmLoi->save();
            
        }

        if (RequestAjax::hasFile('file')) {
            $fileNameSave='';
            foreach (RequestAjax::file('file') as $key => $file) {
                $fileName=time().$key.'.'.$file->getClientOriginalExtension();
                $fileNameSave.=$fileName.';';
                $path = $file->storeAs($this->pathFile, $fileName);
            }
            $dmLoi->file=$fileNameSave;
            $dmLoi->save();
            
        }*/


        return array('error'=>0);
        

        
    }

    public function getDanhMucLoiById(){ 
        if(RequestAjax::ajax()){
            $idUser=Auth::user()->id;
            $id=RequestAjax::get('id');
            /*
            // Cho lấy lên xem
            $dmLoi=DanhMucLoi::where('id_user','=',$idUser)->where('id','=',$id)
                ->get()
                ->toArray();
            if(!$dmLoi){
                return array('error'=>'Bạn chỉ có quyền xem danh mục này');
            }
            */
            $dmLoi=DanhMucLoi::find($id);
            $dmLoi['error']=0;
            return $dmLoi;
        }
    }

    public function xoaDanhMucLoi(Request $request){ 
        $idUser=Auth::user()->id; 
        $roleId=Auth::user()->role_id;
        $idDonVi=Auth::user()->id_don_vi;
        $danhMucLoi=DanhMucLoi::where('id_user','=',$idUser)->where('id','=',$request->id);
        $checkDanhMucLoi=$danhMucLoi->get()->toArray();

        if(count($checkDanhMucLoi)>0){
            $danhMucLoi->delete();
        }
        return redirect()->intended('/admin/danh-muc-loi');
    }

    public function getThongTinDanhMucLoi(RequestAjax $request){
        if(RequestAjax::ajax()){
            $idUser=RequestAjax::get('id');
            $users=User::where('users.id','=',$idUser)
                ->join('admin_role', 'users.role_id', '=', 'admin_role.id')
                ->select('users.id', 'users.name','users.email','users.password','users.role_id', 'users.di_dong', 'admin_role.role_name')
                ->get()
                ->toArray();
            if(!$users){
                return array('error'=>'Không tìm thấy nhân viên cần sửa');
            }
            $users[0]['error']=0;
            return $users[0];
        }
        
    }   


    public function urdDanhMucLoiWord(Request $request){
        $id=$request->id;
        $idUser=Auth::user()->id;
        $danhMucLoi=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.mo_ta', 'dm_loi.hinh_anh', 'dm_loi.file', 'dm_loi.yeu_cau', 'dm_loi.cach_khac_phuc', 'ma_yeu_cau')
        ->join('users','dm_loi.id_user','=','users.id')
        ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
        ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
        ->where('dm_loi.id','=',$id)
        ->where('dm_loi.loai','=','LỖI')
        ->get()->toArray();
        if($danhMucLoi){
            $danhMucLoi=$danhMucLoi[0];    
        }
        else{
            $danhMucLoi=array(); 
        }
        return view('admin.danh-muc-loi.urd-danh-muc-loi-word',compact('danhMucLoi'));
    }


    public function danhMucModuleChucNang(){
        $loaiDanhMucs=LoaiDanhMuc::all()->toArray();
        $donVis=DonVi::select('don_vi.id', 'don_vi.ten_don_vi', 'don_vi.dia_chi', 'don_vi.co_dinh', 'don_vi.fax', 'don_vi.di_dong', 'don_vi.parent', 'don_vi.state')
        ->get()->toArray();
        return view('admin.danh-muc-loi.danh-muc-module-chuc-nang', compact('loaiDanhMucs', 'donVis'));
    }

    public function loadDanhMucModuleChucNang(){
        $idUser=Auth::user()->id; 
        $roleId=Auth::user()->role_id;
        $idDonVi=Auth::user()->id_don_vi;

        // get danh sách danh mục lỗi 1: của chính user này tạo
        $danhMucLoi1=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.ma_yeu_cau', 'link_video_loi', 'loai')
        ->join('users','dm_loi.id_user','=','users.id')
        ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
        ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
        ->orderBy('dm_loi.id', 'desc')
        ->where('dm_loi.id_user','=',$idUser)->where('dm_loi.loai','!=','LỖI')
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
            $danhMucLoi2=DanhMucLoi::select('dm_loi.id', 'dm_loi.ten_dm_loi', 'huong_xu_ly.ten_huong_xu_ly', 'loai_danh_muc.ten_loai_danh_muc', 'users.name', 'dm_loi.state', 'dm_loi.ma_yeu_cau', 'link_video_loi', 'loai')        
            ->join('users','dm_loi.id_user','=','users.id')
            ->join('huong_xu_ly','dm_loi.id_huong_xu_ly','huong_xu_ly.id')
            ->join('loai_danh_muc','dm_loi.id_loai_danh_muc','=','loai_danh_muc.id')
            ->orderBy('dm_loi.id', 'desc')
            ->where('dm_loi.id_user','!=',$idUser)->where('dm_loi.ds_don_vi_duoc_chia_se','like','%'.$idDonViOfUser.'%')->where('dm_loi.loai','!=','LỖI')
            ->get()->toArray();
        }
        $danhMucLois = array_merge($danhMucLoi1, $danhMucLoi2);            
        $view=view('admin.danh-muc-loi.load-danh-muc-module-chuc-nang', compact('danhMucLois'))->render();             
        return response()->json(['html'=>$view]);
    }

    public function getDanhMucModuleChucNangById(Request $request){
        if($request->ajax()){
            $id=RequestAjax::get('id');
            $danhMucLoi=DanhMucLoi::findOrFail($id);
            $danhMucLoi['error']=0;
            return $danhMucLoi;
        }
        return array('error'=>'Vui lòng liên hệ quản trị!');
    }

    public function themDanhMucModuleChucNang(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id_user']=$idUser;
            $data['id_huong_xu_ly']=2;
            // nếu chưa có thêm vô
            DanhMucLoi::create($data);
            return array('error'=>0);
        }
        return array('error'=>1);      
    }

    public function suaDanhMucModuleChucNang(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            
            $data=RequestAjax::all();
            $data['id_user']=$idUser;
            // kiểm tra
            $id=RequestAjax::get('id');
            $check=DanhMucLoi::where('id','=',$id)->where('id_user','=',$idUser)->get()->toArray();
            if(count($check)>0){ // nếu có
                $danhMucLoi=DanhMucLoi::find($id);
                $danhMucLoi->update($data);
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền sửa dữ liệu này.');
            }
        }
        return array('error'=>1);
    }

    public function xoaDanhMucModuleChucNang(Request $request){
        if($request->ajax()){
            $idUser=Auth::user()->id;
            $danhMucLoi=DanhMucLoi::where('id','=',RequestAjax::get('id'))->where('id_user','=',$idUser)->get()->toArray();
            if(count($danhMucLoi)){
                $danhMucLoi=DanhMucLoi::find(RequestAjax::get('id'));
                $danhMucLoi->delete();
                return array('error'=>0);
            }else{
                return array('error'=>'Bạn không có quyền xóa dữ liệu này.');
            }
        }
        return array('error'=>'Đã có lỗi vui lòng liên hệ quản trị.');
        
    }
}
