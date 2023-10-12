<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use PHPUnit\Event\TestSuite\Skipped;

use function Termwind\render;

class PermissionController extends Controller
{
    public function permission(){

        // $permissions = DB::table('permissions')->get()->groupBy('category');
        $permissions = Permission::all();
        $roles = Role::all();
        $role_permissions = DB::table('role_permissions')->get();

        // $user = User::first();
        // dd($user->role->name);
        
        // $index = 0;
        // foreach ($permissions as $permission){ 
        //     foreach($roles as $role){
        //         foreach($role_permissions as $role_permission){
        //             if($role_permission->permission_id == $permission->id){
        //                 if($role->id == $role_permission->role_id){
        //                     $role_array[$role->name] = true;
        //                     break;
        //                 } else {
        //                     $role_array[$role->name] = false;
        //                 }
        //             } 
        //             else{
        //                 $role_array[$role->name] = false;
        //             }
        //         }
        //         $permissions[$index]['roles'] = $role_array;
        //     }
        //     $index++;
        // }
        // dd($permissions->toArray());

            $permissions->each(function ($permission) use ($permissions){
                $permission->roles->each(function ($role) use ($permission){
                    if($permission->id == $role->pivot->permission_id){
                        if($role->id == $role->pivot->role_id){
                            // $role_array[$role->name] = true;
                        } else {
                            // $role_array[$role->name] = false;
                        }
                    } else {
                        // $role_array[$role->name] = false;
                    }
                    // $permissions['roles'] = $role_array;
                });
                
            });
        dd($permissions->toArray());


        $role_permission = DB::table('role_permissions')->get();
        return Inertia::render("permission" , ['roles' => Role::all(),'permissions' => $permissions, 'role_permisssion' => $role_permission ]);

    }
}
