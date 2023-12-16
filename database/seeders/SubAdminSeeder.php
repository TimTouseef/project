<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class SubAdminSeeder extends Seeder
{
    public function run(){
        $subAdminRole = Role::create(['name' => 'sub-admin']);
        $subAdminPermissions = Permission::where('name', 'create employees')->get();

        $subAdmin = User::create([
            'name' => 'Sub Admin',
            'email' => 'sub-admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $subAdmin->roles()->attach($subAdminRole);
        $subAdmin->permissions()->attach($subAdminPermissions);
    }

}
