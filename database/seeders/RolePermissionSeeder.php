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

            // Kelompok
            'kelompok.view',
            'kelompok.create',
            'kelompok.edit',
            'kelompok.delete',

            // Blok
            'blok.view',
            'blok.create',
            'blok.edit',
            'blok.delete',

            // Lahan
            'lahan.view',
            'lahan.create',
            'lahan.edit',
            'lahan.delete',

            // Simpanan
            'simpanan.view',
            'simpanan.create',
            'simpanan.edit',
            'simpanan.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role = Role::firstOrCreate(['name' => 'super admin']);
        $role->givePermissionTo($permissions);
    }
}
