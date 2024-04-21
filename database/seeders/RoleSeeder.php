<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**

    ** PARA LA GUÍA VI EL VIDEO: https://www.youtube.com/watch?v=r5Zs9CGB754&list=PLZ2ovOgdI-kXghwSkvcQ1zVbsyUeYD8Wi&index=3

     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Commander']);
        $role3 = Role::create(['name' => 'Logistic']);
        $role4 = Role::create(['name' => 'Guard']);

        //PARA UN SOLO ROL A UN PERMISO
        //Permission::create(['name' => 'admin.index'])->assignRole($role1);

        //PARA VARIOS ROLES A UN PERMISO
        Permission::create(['name' => 'home'])->syncRoles([$role1, $role2, $role3, $role4]);

        //PARA SALVOCONDUCTOS
        Permission::create(['name' => 'pass.view'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'pass.create'])->syncRoles([ $role3]);
        Permission::create(['name' => 'pass.authorized'])->syncRoles([$role2]);

        //PARA ADMINISTRADOR
        Permission::create(['name' => 'admin.index'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'superAdmin.index'])->assignRole($role1);

        //PARA GUARDIAS PREVENCIÓN
        Permission::create(['name' => 'guard.index'])->syncRoles([$role4]);

        //PERMISO PARA CONSIGNAS
        Permission::create(['name' => 'pending.index'])->syncRoles([$role4, $role2, $role3]);

    }
}
