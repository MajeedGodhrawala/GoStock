<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use PHPUnit\Event\TestSuite\Skipped;

use function Termwind\render;

class PermissionController extends Controller
{
    public function permission(){
        return Inertia::render("permission" , ['roles' => Role::all(),'role_permissions' => $this->rolePermission()]);
    }

    public function rolePermission() : object
    {
        $permissions = Permission::orderBy('category')->get();
        $roles = Role::with('permissions')->get();

        $role_permission_array = collect();
        foreach($permissions as $permission){
            $role_permission_array->push([
                'id' => $permission->id,
                'name' => $permission->name,
                'display_name' => $permission->display_name,
                'category' => $permission->category,
                'roles' => $this->getPermissionByRoles($permission->id,$roles)
            ]);
        }

        // dd($role_permission_array->groupBy('category'));
        $role_permissions = $role_permission_array->groupBy('category');
        return $role_permissions;
    }

    public function getPermissionByRoles(float $permission_id,Collection $roles): array
    {
        $roles_array = [];

        foreach($roles as $role){
            $exists = $role->permissions->where('id','=',$permission_id)->first(); 

            array_push($roles_array,[
                'id' => $role->id,
                'name' => $role->name,
                'display_name' => $role->display_name,
                'has_permission' => $exists ? true : false,
            ]);

        }

        return $roles_array;
    }

    public function updateRolePermission(Request $datas){
        foreach($datas->role_permission as $role_id=>$data){
            $role = Role::with('permissions')->find($role_id);
            $role->permissions()->sync($data);
        }

        return response()->json(['updated' => 'Permission Has Been Updated','role_permissions' => $this->rolePermission()]);
    }
}
