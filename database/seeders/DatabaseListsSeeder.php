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
        DatabaseLists::insert([
            ['name' => 'MYSQL'],
            ['name' => 'MONGO-DB'],
            ['name' => 'ORACLE'],
            ['name' => 'POSTGRE-SQL'],
            ['name' => 'MONGO-DB'], // Make sure the names are unique
        ]);        
    }
}
