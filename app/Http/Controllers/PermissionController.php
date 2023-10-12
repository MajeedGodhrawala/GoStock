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
        $permissions = Permission::with('roles')->get();
        // $roles = Role::all();
        // $role_permissions = DB::table('role_permissions')->get();

        // $user = User::first();
        // dd($user->role->name);
        
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
        //         $permission['roles'] = $role_array;
        //     }
        // }
        // dd($permissions->toArray());

            // $permissions->each(function ($permission) use ($permissions){
            //     $permission->roles->each(function ($role) use ($permission){
            //         if($permission->id == $role->pivot->permission_id){
            //             if($role->id == $role->pivot->role_id){
            //                 // $role_array[$role->name] = true;
            //             } else {
            //                 // $role_array[$role->name] = false;
            //             }
            //         } else {
            //             // $role_array[$role->name] = false;
            //         }
            //         // $permissions['roles'] = $role_array;
            //     });
                
            // });

            foreach($permissions as $permission){
                $role_array = [];
                foreach($permission->roles as $permission_role){
                    if($permission_role->pivot->permission_id == $permission->id && $permission_role->id == $permission_role->pivot->role_id){
                        dump(1);
                        $role_array[$permission_role->name] = true;
                    } else {
                        dump(1);
                        $role_array[$permission_role->name] = false;
                    }

                    dump($role_array);
                }

                dump($role_array);
                $permission['roles'] = $role_array;
            }


            
        dd($permissions);


        $role_permission = DB::table('role_permissions')->get();
        return Inertia::render("permission" , ['roles' => Role::all(),'permissions' => $permissions, 'role_permisssion' => $role_permission ]);

    }
}
