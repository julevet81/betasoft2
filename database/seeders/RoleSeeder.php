<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'employee',
            'client',
            'manager',
            'guest',
            'internship',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role, 'guard_name' => 'web']);
        }

        // $role_admin = Role::create(['name' => 'admin']);
        // $permission_manage_users = 'manage-users';

        // $role_admin->givePermissionTo($permission_manage_users);

        // $user = User::find(1); // Assuming the first user is the admin

        // $user->assignRole($role_admin);
    }
}
