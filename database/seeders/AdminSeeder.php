<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $adminPermissions = Permission::all();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $admin->roles()->attach($adminRole);
        $admin->permissions()->attach($adminPermissions);
    }
}
