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
        Framework::create(
            [
                'name'  =>  'LARAVEL'
            ]
        );

        Framework::create(
            
            [
                'name'  =>  'DJANGO'
            ]
        );

        Framework::create(
            
            [
                'name'  =>  'CORE-PHP'
            ]
        );

        Framework::create(
            
            [
                'name'  =>  'CORE-PYTHON'
            ]
        );
    }
}
