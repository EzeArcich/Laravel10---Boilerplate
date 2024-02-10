<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; 
use Carbon\Carbon;



class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Role::create(['id' => 1, 'name' => 'Super admin', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now]);
        Role::create(['id' => 2, 'name' => 'Emprendedor', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now]);
        Role::create(['id' => 3, 'name' => 'Franquisiado', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now]);
        Role::create(['id' => 4, 'name' => 'Inmobiliario', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now]);

        Permission::create(['name' => 'launch-campaigns']);
        Permission::create(['name' => 'analytics']);
        Permission::create(['name' => 'create-projects']);
        Permission::create(['name' => 'one-projects']);
        Permission::create(['name' => 'multiple-projects']);
        Permission::create(['name' => 'only-view']);
        Permission::create(['name' => 'connect-accounts']);

        $adminRoles = Role::whereIn('name', ['Emprendedor', 'Franquisiado', 'Inmobiliario'])->get();

        foreach ($adminRoles as $adminRole) {
            $adminRole->givePermissionTo('launch-campaigns', 'analytics', 'create-projects', 'one-projects', 'connect-accounts');
        }

        $superAdminRole = Role::where('name', 'Super admin')->first();
        $superAdminRole->givePermissionTo('launch-campaigns', 'analytics', 'create-projects', 'multiple-projects', 'connect-accounts');
    }
}
