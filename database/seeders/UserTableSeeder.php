<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create an admin user
        $user = User::create([
            'name' => 'Admin User',
            'cpfNo' => '11008872', 
            'email' => 'admin@ongc.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('Admin');
    }
}
