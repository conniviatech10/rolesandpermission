<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
    
        $manageArticlesPermission = Permission::create(['name' => 'manage articles']);
        $publishArticlesPermission = Permission::create(['name' => 'publish articles']);
    
        $adminRole->givePermissionTo($manageArticlesPermission, $publishArticlesPermission);
        $editorRole->givePermissionTo($manageArticlesPermission);
    
    }
}
