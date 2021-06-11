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
use App\ToDo;
class ToDoController extends Controller
{
    public function toDo(){
        $idUser=Auth::user()->id;
        $idDonViGoc=Auth::user()->id_don_vi;
        // id đơn vị
        $idDonVi='';
        $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
        if(count($userDonVis)>0){
            $idDonVi=$userDonVis[0]['id_don_vi'];
        }

        
        return view('admin.to-do.to-do');
    }

    public function themToDo(Request $request){
        if($request->ajax()){
             $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            // id đơn vị
            $idDonVi='';
            $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
            if(count($userDonVis)>0){
                $idDonVi=$userDonVis[0]['id_don_vi'];
            }
            $data=RequestAjax::all();
            unset($data['id']);
            $data['id_user']=$idUser;
            $toDo=ToDo::create($data);
            return array('error'=>0);
            
        }
        return array('error'=>'Phương thức không được chấp nhận');
    }



    public function loadDsMyToDo(Request $request){
        if($request->ajax()){
             $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            // id đơn vị
            $idDonVi='';
            $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
            if(count($userDonVis)>0){
                $idDonVi=$userDonVis[0]['id_don_vi'];
            }
            $toDos=ToDo::where('id_user','=',$idUser)->orderBy('sap_xep')->get();

            // Cần xử lý
            $dsCongViecChoXuLys=DB::select('select t3.id, t4.ten_cong_viec, t5.trang_thai as trang_thai_xu_ly, ("Chờ XL") as loai_cong_viec, t4.han_xu_ly_cong_viec
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
            // Cần giao
            $dsCongViecChoGiaos=DB::select('select t3.id, t4.ten_cong_viec, t5.trang_thai as trang_thai_xu_ly, ("Chờ PC") as loai_cong_viec, t4.han_xu_ly_cong_viec
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
            
            
            // Cần lãnh đạo hỗ trợ
            $dsCongViecChoLdHoTros=DB::select('select t3.id, t4.ten_cong_viec, t5.trang_thai as trang_thai_xu_ly, ("Chờ HT") as loai_cong_viec, t4.han_xu_ly_cong_viec
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
            // Cần lãnh đạo duyệt
            $dsCongViecChoLdDuyets=DB::select('select t3.id, t4.ten_cong_viec, t5.trang_thai as trang_thai_xu_ly, ("Chờ DT") as loai_cong_viec, t4.han_xu_ly_cong_viec
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

            $dsCongViecs=array_merge($dsCongViecChoXuLys, $dsCongViecChoGiaos, $dsCongViecChoLdHoTros, $dsCongViecChoLdDuyets);


            $view=view('admin.to-do.load-ds-my-to-do', compact('toDos', 'dsCongViecs'))->render();             
            return response()->json(['html'=>$view]);
        }
        return array('error'=>'Phương thức không được chấp nhận');
    }


    public function getToDoById(Request $request){
        if($request->ajax()){
             $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            // id đơn vị
            $idDonVi='';
            $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
            if(count($userDonVis)>0){
                $idDonVi=$userDonVis[0]['id_don_vi'];
            }
            $data=RequestAjax::all();
            if(isset($data['id']) && $data['id']){
                $toDo=ToDo::findOrFail($data['id']);
                return array('error'=>0,'data'=>$toDo);
            }
            return array('error'=>'Không tìm thấy công việc cần sửa');
        }
        return array('error'=>'Phương thức không được chấp nhận');
    }



    public function updateToDo(Request $request){
        if($request->ajax()){
             $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            // id đơn vị
            $idDonVi='';
            $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
            if(count($userDonVis)>0){
                $idDonVi=$userDonVis[0]['id_don_vi'];
            }

            $data=RequestAjax::all();
            if(isset($data['id']) && $data['id']){
                $toDo=ToDo::findOrFail($data['id']);
                $toDo->update($data);
                return array('error'=>0);
            }
            return array('error'=>'Không tìm thấy công việc cần sửa');
        }
        return array('error'=>'Phương thức không được chấp nhận');
    }


    public function capNhatTrangThaiToDo(Request $request){
        if($request->ajax()){
             $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            // id đơn vị
            $idDonVi='';
            $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
            if(count($userDonVis)>0){
                $idDonVi=$userDonVis[0]['id_don_vi'];
            }

            $data=RequestAjax::all();
            if(isset($data['id']) && $data['id']){
                $toDo=ToDo::findOrFail($data['id']);
                $toDo->trang_thai=$data['trang_thai'];
                $toDo->save();
                return array('error'=>0);
            }
            return array('error'=>'Không tìm thấy công việc cần sửa');
        }
        return array('error'=>'Phương thức không được chấp nhận');
    }

    public function capNhatThuTuToDo(Request $request){
        if($request->ajax()){
             $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            // id đơn vị
            $idDonVi='';
            $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
            if(count($userDonVis)>0){
                $idDonVi=$userDonVis[0]['id_don_vi'];
            }

            $dsId=RequestAjax::get('ds_id');
            $arrDsId=explode(";", $dsId);
            foreach ($arrDsId as $key => $id) {
                $stt=$key+1;
                if($id){
                    $toDo=ToDo::findOrFail($id);
                    $toDo->sap_xep=$stt;
                    $toDo->save();
                }

            }
            
            return array('error'=>0);
        }
        return array('error'=>'Phương thức không được chấp nhận');
    }


    


    public function deleteToDo(Request $request){
        if($request->ajax()){
             $idUser=Auth::user()->id;
            $idDonViGoc=Auth::user()->id_don_vi;
            // id đơn vị
            $idDonVi='';
            $userDonVis=UserDonVi::where('id_users','=',$idUser)->get()->toArray();
            if(count($userDonVis)>0){
                $idDonVi=$userDonVis[0]['id_don_vi'];
            }
            $id=RequestAjax::get('id');
            $toDo=ToDo::findOrFail($id);
            $toDo->delete();
            return array('error'=>0);
        }
        return array('error'=>'Phương thức không được chấp nhận');
    }
   
}
