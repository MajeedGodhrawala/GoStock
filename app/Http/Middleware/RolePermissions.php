<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permissions = null): Response
    {
        
        $permission_array = [];
        foreach(explode('|',$permissions) as $permission){
            array_push($permission_array,$permission);
        }
        if($request->id){
            dd("GetId");
        } else {
            dd("NotGetId");
        }
        $user = Auth::user();
        // $user = User::find(Auth::user()->id);
        $user->load('role.permissions');
        $has_permission = $user->role->permissions->whereIn('name', $permission_array)->first();
        if($has_permission){
            return $next($request);
        } else{
            return redirect()->route(404);
        }     
    }
}
