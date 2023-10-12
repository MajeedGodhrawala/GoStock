<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'display_name' => 'Admin'
        ]);
        Role::create([
            'name' => 'user',
            'display_name' => 'User'
        ]);
        Role::create([
            'name' => 'manager',
            'display_name' => 'Manager'
        ]);
    }
}
