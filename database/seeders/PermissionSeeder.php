<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'view_user',
                'display_name' =>  'View User',
                'category' => 'User'
            ],
            [
                'name' => 'view_profile',
                'display_name' =>  'View Profile',
                'category' => 'Profile'
            ],
            [
                'name' => 'edit_profile',
                'display_name' =>  'Edit Profile',
                'category' => 'Profile'
            ],
            [
                'name' => 'view_broker',
                'display_name' =>  'View Broker',
                'category' => 'Broker'
            ],
            [
                'name' => 'add_broker',
                'display_name' =>  'Add Broker',
                'category' => 'Broker'
            ],
            [
                'name' => 'edit_broker',
                'display_name' =>  'edit Broker',
                'category' => 'Broker'
            ],
            [
                'name' => 'edit_temp',
                'display_name' =>  'edit Temp',
                'category' => 'Temp'
            ],
        ];

        foreach($datas as $data ){
            Permission::create($data);
        }
        
        $role_permissions = [];

        $roles = Role::all();
        $permissions = Permission::all();

        foreach($roles as $role){
            foreach($permissions as $permission){
                if($role->name == "admin"){
                    if($permission->name != "edit_temp"){
                        array_push($role_permissions,['role_id' => $role->id , 'permission_id' => $permission->id]);
                    } 
                } elseif($role->name == "user") {
                    if(str_contains($permission->name,'profile')){
                        array_push($role_permissions,['role_id' => $role->id , 'permission_id' => $permission->id ]);
                    }
                } elseif($role->name == "manager") {
                    if(str_contains($permission->name,'temp')){
                        array_push($role_permissions,['role_id' => $role->id , 'permission_id' => $permission->id ]);
                    }
                } 
            }
        }
        

        foreach($role_permissions as $data){
            DB::table('role_permissions')->insert($data);
        }
    }
}
