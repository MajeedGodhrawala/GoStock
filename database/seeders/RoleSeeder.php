<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Admin'
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
            'display_name' => 'User'
        ]);
        DB::table('roles')->insert([
            'name' => 'manager',
            'display_name' => 'Manager'
        ]);
    }
}
