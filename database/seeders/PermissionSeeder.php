<?php

namespace Database\Seeders;

use App\Models\Permission;
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
            'create-invoices',
            'edit-invoices',
            'delete-invoices',
            'view-invoices',
            'create-internships',
            'edit-internships',
            'delete-internships',
            'view-internships',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
