<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            // Dashboard
            'dashboard.view',
            
            // User Management
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            
            // Role Management
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // Peserta Plasma
            'peserta_plasma.view',
            'peserta_plasma.create',
            'peserta_plasma.edit',
            'peserta_plasma.delete',

            // Petani
            'petani.view',
            'petani.create',
            'petani.edit',
            'petani.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role = Role::firstOrCreate(['name' => 'super admin']);
        $role->givePermissionTo($permissions);
    }
}
