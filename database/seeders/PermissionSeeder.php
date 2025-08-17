<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage-users',
            'view-dashboard',
            'manage-roles',
            'manage-permissions',
            'create-employees',
            'edit-employees',
            'delete-employees',
            'view-employees',
            'create-clients',
            'edit-clients',
            'delete-clients',
            'view-clients',
            'create-projects',
            'edit-projects',
            'delete-projects',
            'view-projects',
            'create-tasks',
            'edit-tasks',
            'delete-tasks',
            'view-tasks',
            'view-users',
            'create-internships',
            'edit-internships',
            'delete-internships',
            'view-internships',
            'create-roles',
            'edit-roles',
            'delete-roles',
            'view-roles',
            'create-permissions',
            'edit-permissions',
            'delete-permissions',
            'view-permissions',
            'create-payments',
            'edit-payments',
            'delete-payments',
            'view-payments',
            'create-summaries',
            'edit-summaries',
            'delete-summaries',
            'view-summaries',
            'view_contracts',
            


        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // $role_admin = Role::where('name', 'admin')->first();

        // $role_admin->syncPermissions(Permission::all());
    }
}
