<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create denominations']);
        Permission::create(['name' => 'view denominations']);
        Permission::create(['name' => 'edit denominations']);
        Permission::create(['name' => 'delete denominations']);

        Permission::create(['name' => 'create prizes']);
        Permission::create(['name' => 'view prizes']);
        Permission::create(['name' => 'edit prizes']);
        Permission::create(['name' => 'delete prizes']);

        Permission::create(['name' => 'create draws']);
        Permission::create(['name' => 'view draws']);
        Permission::create(['name' => 'edit draws']);
        Permission::create(['name' => 'delete draws']);

        Permission::create(['name' => 'create draw-results']);
        Permission::create(['name' => 'view draw-results']);
        Permission::create(['name' => 'edit draw-results']);
        Permission::create(['name' => 'delete draw-results']);
//
//        // create roles and assign existing permissions
//        $role1 = Role::create(['name' => 'writer']);
//        $role1->givePermissionTo('edit articles');
//        $role1->givePermissionTo('delete articles');
//
//        $role2 = Role::create(['name' => 'admin']);
//        $role2->givePermissionTo('publish articles');
//        $role2->givePermissionTo('unpublish articles');


//        $role1 = Role::create(['name' => 'Super-Admin']);
//
//        $role2 = Role::create(['name' => 'user']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider


//        User::find(1)->assignRole($role1);

//        $user = \App\Models\User::factory()->create([
//            'name' => 'Example Admin User',
//            'email' => 'admin@example.com',
//        ]);
//        $user->assignRole($role2);
//
//        $user = \App\Models\User::factory()->create([
//            'name' => 'Example Super-Admin User',
//            'email' => 'superadmin@example.com',
//        ]);
//        $user->assignRole($role3);
    }
}
