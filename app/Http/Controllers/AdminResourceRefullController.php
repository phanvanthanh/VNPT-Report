<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\AdminResource;
use DB;
use App\ThongTinThanhToan;
use App\AdminRule;

class AdminResourceRefullController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = DB::table('admin_resource')
            ->get()
          ->toArray();
        return view('admin.resource.index',compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // cập nhật lại trạng thái resource về 0
        $allResource = AdminResource::where('status', '=', '1')->where('uri','!=','#')->get();
        foreach($allResource as $row) {
            $row->status = 0;
            $row->save();
        }
        
        
        
        $routeCollection = Route::getRoutes();
        $stt=0;
        foreach ($routeCollection as $value) {            
            
            
            // Điều kiện để xác định một resource đã tồn tại
            $method=$value->methods(); $method=$method[0];
            $action=$value->getActionName();
            $arrayParrameterName=$value->parameterNames();
            if($action!='Closure'){
                $stt++;
                // kiểm tra dữ liệu trong bảng AdminResource theo điều kiện
                $adminResourceExist=AdminResource::where('method',$method)->where('action',$action)->where('status',0)->get();
                $adminResourceExist1=$adminResourceExist;
                $adminResourceExist=$adminResourceExist->toArray();
                // nếu chưa tồn tại resource thì tạo mới
                if(!isset($adminResourceExist[0]['id'])){
                    // Đối tượng AdminResource
                    $adminResource=new AdminResource();
                    $adminResource->ten_hien_thi        = '';
                    $adminResource->resource        = $method.' | '.$action;
                    $adminResource->method          = $method;
                    $adminResource->action          = $action;
                    $adminResource->uri          = $value->uri();
                    $adminResource->order          = $stt;
                    $adminResource->ten_hien_thi          = $value->uri();
                    $showMenu=0;
                    if($method=='GET'){
                        $showMenu=1;
                    }

                    $adminResource->show_menu          = $showMenu;
                    $parameterName='';
                    $parameterValue='';
                    if(count($arrayParrameterName)>0 && isset($arrayParrameterName[0]) && $arrayParrameterName[0]!='resource' && $arrayParrameterName[0]!='token'){
                        foreach ($arrayParrameterName as $key => $prmt) {
                            if($key==0){
                                $parameterName='';
                                $parameterValue='';
                            }
                            else{
                                $parameterName.='';
                                $parameterValue.='';
                            }
                        }
                    }
                    $adminResource->parameter       = $parameterName;
                    $adminResource->parameter_value = $parameterValue;
                    $adminResource->status = 1;
                    $adminResource->parent_id = 1;

                    // phải sửa khúc này
                    $adminResource->use_when_login = 1;
                    $strUri=$value->uri();
                    $arrUri=explode('/', $strUri);
                    
                    
                  
                    
                    
                    $adminResource->only_show_admin = 1;
                    $adminResource->save();
                }
                else{
                    foreach ($adminResourceExist1 as $key => $exist) {
                        $exist->status=1;
                        $exist->uri          = $value->uri();
                        
                        if($exist->ten_hien_thi==''){
                            $exist->ten_hien_thi=$value->uri();
                        }

                        
                        $strUri=$value->uri();
                        $arrUri=explode('/', $strUri);
                        


                        $exist->parameter       = '';
                        $exist->parameter_value = '';
                        $exist->save();
                    }
                }
            }               
        }
        // Xóa bỏ những quyền rác
        $allResourceDelete = AdminResource::where('status', '=', '0')->get();
        foreach($allResourceDelete as $row) {
            // delete rule
            $rule=AdminRule::where('resource_id','=',$row->id);
            $rule->delete();
            $row->delete();
        }
        return redirect()->intended('/admin/resource');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=$request->id;
        $ten_hien_thi=$request->ten_hien_thi;
        $show_menu=$request->show_menu;
        $adminResource=AdminResource::findOrFail($id);
        $adminResource->ten_hien_thi=$ten_hien_thi;
        if($show_menu==''){
            $show_menu=0;
        }
        $adminResource->show_menu=$show_menu;
        $adminResource->save();
        return redirect()->intended('/admin/resource');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        //$time = date('r');
        
        $thongTinThanhToan=DB::select('select max(id) as max from thong_tin_thanh_toan');
        $max=$thongTinThanhToan[0]->max;
        $id=0;
        if($id!=$max){

            echo "data: Thời gian trên máy chủ hiện tại là: {$max}\n\n";        
            flush();
        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        //
        return view('admin.errors.405');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return view('admin.errors.405');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return view('admin.errors.405');

    }
}
