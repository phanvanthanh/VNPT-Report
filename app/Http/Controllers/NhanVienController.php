<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\NhanVienRequest;
use App\DanhMuc;
use App\User;
use App\AdminRole;
use App\DonVi;
use App\UsersChucDanh;
use DB;
use Auth;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
class NhanVienController extends Controller
{

    //
    public function NhanVien(){
        $idUser=Auth::user()->id; 
        $roleId=Auth::user()->role_id; 
        $idDonVi=Auth::user()->id_don_vi; 

        $users=User::where('users.id','!=',0)->where('users.id','!=',1)->where('users.id_don_vi','=',$idDonVi)
        ->leftJoin('admin_role', 'users.role_id', '=', 'admin_role.id')
        ->leftJoin('users_don_vi', 'users.id', '=', 'users_don_vi.id_users')
        ->leftJoin('don_vi', 'users_don_vi.id_don_vi', '=', 'don_vi.id')
        ->select('users.id', 'users.name','users.email','users.password','users.role_id', 'users.di_dong', 'admin_role.role_name', 'users.state', 'don_vi.ten_don_vi')
        ->get()->toArray();
        $roles=AdminRole::where('id','!=',0)->where('id','!=',1)->get();

        // chỉ có quản trị mới được thấy tài khoản của quản trị
        if($roleId==1){
            $users=User::join('admin_role', 'users.role_id', '=', 'admin_role.id')
            ->select('users.id', 'users.name','users.email','users.password','users.role_id', 'users.di_dong', 'admin_role.role_name', 'users.state', 'don_vi.ten_don_vi')
            ->leftJoin('users_don_vi', 'users.id', '=', 'users_don_vi.id_users')
            ->leftJoin('don_vi', 'users_don_vi.id_don_vi', '=', 'don_vi.id')
            ->get()->toArray();
            $roles=AdminRole::get();
        }
        
        $donVis=DonVi::where('id','=',$idDonVi)->get()->toArray();
        $chucDanhs=UsersChucDanh::all();
        // chỉ có tài khoản quản trị mới được tạo tài khoản cho các đơn vị khác nhau, ngược lại chỉ được tạo tài khoản cho đơn vị của mình quản lý thôi
        if($roleId==1){
            $donVis=DonVi::where('parent','=',null)->get()->toArray();
        }


        
    	return view('admin.nhan-vien.nhan-vien',compact('users','roles', 'donVis', 'chucDanhs'));
    }

    public function TaoNhanVien(NhanVienRequest $nhanVienRequest){
        // check tài khoản đăng nhập có tồn tại chưa
        $user=User::create([
            'name'      => $nhanVienRequest->name,
            'email'     => $nhanVienRequest->email,
            'di_dong'   => $nhanVienRequest->di_dong,
            'password'  => bcrypt($nhanVienRequest->password),
            'role_id'   => $nhanVienRequest->role_id,
            'id_don_vi'   => $nhanVienRequest->id_don_vi,
            'id_chuc_danh'   => $nhanVienRequest->id_chuc_danh,
        ]);
        return redirect()->intended('/admin/nhan-vien');
    }


    
    public function suaNhanVien(Request $request){ 
        if(!$request->id){            
            return redirect('/admin/nhan-vien')->with('error', 'Lỗi không tìm thấy nhân viên!'); 
        }
        $users=User::where('id','=',$request->id)->get()->toArray();
        if(count($users)<=0){
            return redirect('/admin/nhan-vien')->with('error', 'Lỗi không tìm thấy nhân viên!'); 
        }

        $user=User::findOrFail($request->id);
        // không cho sửa email nên không gắng vô
        $user->name=$request->name;
        $user->id_don_vi=$request->id_don_vi;
        $user->di_dong=$request->di_dong;
        if($request->password){
            $user->password=bcrypt($request->password);
        }        
        $user->role_id=$request->role_id;

        if($request->state!='' && $request->state!='Chọn trạng thái'){
            $user->state=$request->state;
        }

        $user->save();

        return redirect()->intended('/admin/nhan-vien');
    }

    public function xoaNhanVien(Request $request){  
        if(!$request->id){
            return redirect()->intended('/admin/nhan-vien');
        }
        $users=User::where('id','=',$request->id)->get()->toArray();
        if(count($users)<=0){
            return redirect()->intended('/admin/nhan-vien');
        }
        $user=User::findOrFail($request->id); 
        if($request->id!=1){
            $user->delete();  
        }
          
        return redirect()->intended('/admin/nhan-vien');
    }

    public function getThongTinNhanVien(RequestAjax $request){
        if(RequestAjax::ajax()){

            $idUser=RequestAjax::get('id');

            $users=User::where('users.id','=',$idUser)
                ->join('admin_role', 'users.role_id', '=', 'admin_role.id')
                ->join('don_vi', 'users.id_don_vi', '=', 'don_vi.id')
                ->select('users.id', 'users.name','users.email','users.password','users.role_id', 'users.di_dong', 'admin_role.role_name', 'users.id_don_vi', 'don_vi.ten_don_vi')
                ->get()
                ->toArray();
            if(!$users){
                return array('error'=>'Không tìm thấy nhân viên cần sửa');
            }
            $users[0]['error']=0;
            return $users[0];
        }
        
    }   

    
}
