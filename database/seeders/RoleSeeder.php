<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        // Create admin role
        $adminRole = Role::create(['name' => 'admin']);

        // Assign permissions to admin role
        $adminRole->syncPermissions([
            'create-post',
            'delete-post',
            // Add more permissions as needed
        ]);
        foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
        $adminRole->givePermissionTo($permission);
    }
    }
}
