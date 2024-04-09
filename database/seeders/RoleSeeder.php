<?php

namespace Database\Seeders;
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
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Guard']);
        $role3 = Role::create(['name' => 'Logistic']);

        Permission::create(['name' => 'admin'])->syncRoles($role1);
        Permission::create(['name' => 'guard'])->syncRoles([$role1, $role2, $role3]);
    }
}
