<?php

namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Support\Facades\Route;
use App\AdminResource;
use Illuminate\Support\Facades\Auth;
use DB;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $userId = Auth::id();
        // $currentAction=Route::getCurrentRoute()->getActionName();
        // $currentMethods=Route::getCurrentRoute()->methods()[0];

        // $checkPermissionResource = AdminResource::where('admin_resource.action', '=', $currentAction)
        // ->where('admin_resource.method','=',$currentMethods)
        // ->where('users.id','=',$userId)
        // ->join('admin_rule', 'admin_resource.id', '=', 'admin_rule.resource_id')
        // ->join('users', 'admin_rule.role_id', '=', 'users.role_id')
        // ->get()->toArray();
        // // Route::getCurrentRoute()->parameterNames();
        // if(count($checkPermissionResource)<=0){
        //     return redirect()->intended('/');
        //     echo 'Bạn không có quyền truy cập địa chỉ này';
        //     die();
        // }
        return $next($request);
    }
}
