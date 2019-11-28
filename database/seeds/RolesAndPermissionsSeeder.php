<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'publish users']);
        Permission::create(['name' => 'unpublish users']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'member']);
        $role->givePermissionTo('edit users');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['publish users', 'unpublish users']);

        $role = Role::create(['name' => 'head of library']);
        $role->givePermissionTo(Permission::all());
    }
}
