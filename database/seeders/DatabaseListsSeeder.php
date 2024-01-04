<?php

namespace Database\Seeders;

use App\Models\DatabaseLists;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DatabaseLists::create(
            [
                'name'  =>  'MYSQL',
            ]
        );

        DatabaseLists::create(
            
            [
                'name'  =>  'MONGO-DB',
            ]
        );

        DatabaseLists::create(
            
            [
                'name'  =>  'ORACLE',
            ]
            
        );

        DatabaseLists::create(
            
            [
                'name'  =>  'POSTGRE-SQL',
            ]
        );

        DatabaseLists::create(
            
            [
                'name'  =>  'MONGO-DB',
            ]
        );
    }
}
