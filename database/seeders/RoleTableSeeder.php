<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RoleHasPermission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin','CISO','User'];
        $permissions = Permission::pluck('id')->all();
        
        foreach ($roles as $role) {
            $roleSeeder = new Role;
            $roleSeeder->name = $role;
            $roleSeeder->save();
            $roleSeeder->syncPermissions($permissions);
        }
    }
}
