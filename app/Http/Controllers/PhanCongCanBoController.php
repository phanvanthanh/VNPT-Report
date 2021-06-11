<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\DonVi;
use App\User;
use App\UserDonVi;
use DB;
use Auth;
use Request as RequestAjax;
use Illuminate\Support\Facades\Redirect;
class PhanCongCanBoController extends Controller
{

    public function phanDonViChoCanBo(){
        return view('admin.phan-don-vi-cho-nhan-vien.phan-don-vi-cho-nhan-vien');
    }

    public function loadUserChuaPhanDonVi(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        $userDonVis=DB::select('select u.id, u.name, udv.id as id_users_don_vi, dv.ten_don_vi from users as u
            left join users_don_vi as udv on u.id=udv.id_users
            left join don_vi as dv on udv.id_don_vi=dv.id
            where u.id_don_vi='.$idDonViGoc);
        $view=view('admin.phan-don-vi-cho-nhan-vien.load-user-chua-phan-don-vi', compact('userDonVis'))->render();             
        return response()->json(['html'=>$view]);
    }

    public function loadDmDonViCanPhan(){
    	$idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;

    	$donVis1=DonVi::select('don_vi.id', 'don_vi.ten_don_vi', 'don_vi.parent')
        ->get()->toArray(); 
        // chú ý nếu như không lấy được user vào trong đơn vị có thể user đó có đơn vị gốc là đơn vị khác
        $users=User::select('users.name as ten_don_vi', 'users_don_vi.id_don_vi as parent', 'users.id as id')
        ->join('users_don_vi','users.id','=','users_don_vi.id_users')
        ->where('users.id_don_vi','=',$idDonViGoc)
        ->get()->toArray();
        $users1=array();
        foreach ($users as $key => $user) {
        	$user['id']='userId:'.$user['id'];
        	$users1[]=$user;
        }

        $donVis = array_merge($users1, $donVis1);
        $view=view('admin.phan-don-vi-cho-nhan-vien.load-dm-don-vi-can-phan', compact('donVis'))->render();             
        return response()->json(['html'=>$view]);  
    }

    public function capNhatPhanDonViChoCanBo(){
    	$idDonViGoc=Auth::user()->id_don_vi;
    	// cắt chuổi
    	$dsIdUsers=RequestAjax::get('id_users');
    	$idDonVi=RequestAjax::get('id_don_vi');

    	$dsIdUsers=explode(";", $dsIdUsers);
    	// duyệt qua từng id user xóa phân công cũ
    	$dsLoi='';
    	foreach ($dsIdUsers as $key => $value) {
    		if($value){
    			$checkIdDonViGoc=User::where('id_don_vi','=',$idDonViGoc)->where('id','=',$value)->get()->toArray();
	    		if(count($checkIdDonViGoc)>0){
	    			$userDonVis=UserDonVi::where('id_users','=',$value)->get();
	    			if(count($userDonVis)>0){
	    				// phân công lại
	    				$userDonVi=$userDonVis[0];
	    				$userDonVi->id_don_vi=$idDonVi;
	    				$userDonVi->save();
	    			}
	    			else{
	    				// phân công mới
	    				$userDonVi=new UserDonVi();
	    				$userDonVi->id_users=$value;
	    				$userDonVi->id_don_vi=$idDonVi;
	    				$userDonVi->save();
	    			}
	    		}else{ // ngược lại không thuộc đơn vị của user sửa
	    			$dsLoi='Có một số tài khoản chưa phân đơn vị được. <br>Vui lòng kiểm tra lại!';
	    		}
    		}
	    		
    	}
    	if($dsLoi){
    		return array('error'=>1,'message'=>$dsLoi);
    	}
        return array('error'=>0,'message'=>'');
    }
    
}
