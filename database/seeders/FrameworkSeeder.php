<?php

namespace Database\Seeders;

use App\Models\Framework;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrameworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Framework::insert([
            ['name' => 'LARAVEL'],
            ['name' => 'DJANGO'],
            ['name' => 'CORE-PHP'],
            ['name' => 'CORE-PYTHON'],
        ]);
    }
}
