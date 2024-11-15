<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'COMPLAINT:LIST']);
        Permission::create(['name' => 'COMPLAINT:FILTER']);
        Permission::create(['name' => 'COMPLAINT:VIEW']);
        Permission::create(['name' => 'COMPLAINT:CREATE']);
        Permission::create(['name' => 'COMPLAINT:EDIT']);
        Permission::create(['name' => 'COMPLAINT:DELETE']);
        Permission::create(['name' => 'COMPLAINT_ACTION:EDIT']);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'COMPLAINT:LIST',
                'COMPLAINT:FILTER',
                'COMPLAINT:VIEW',
                'COMPLAINT:CREATE',
                'COMPLAINT:EDIT',
                'COMPLAINT:DELETE'
            ]);

        Role::create(['name' => 'investigator'])
            ->givePermissionTo([
                'COMPLAINT:LIST',
                'COMPLAINT:VIEW',
                'COMPLAINT_ACTION:EDIT'
            ]);

        Role::create(['name' => 'super-admin'])
            ->givePermissionTo(Permission::all());
    }
}
