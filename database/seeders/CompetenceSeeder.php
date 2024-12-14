<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('competence')->insert([
            ['name' => 'FRONTEND', 'description' => 'Znajomość pracy na frontendzie aplikacji'],
            ['name' => 'BACKEND', 'description' => 'Umiejętność pracy na backendzie aplikacji'],
            ['name' => 'DEVOPS', 'description' => 'Umiejętności devops'],
            ['name' => 'DATA SCIENCE', 'description' => 'Umiejętności pracy na big data'],
            ['name' => 'CYBER SECURITY', 'description' => 'Umiejętności cyber security'],
            ['name' => 'JAVA', 'description' => 'Umiejętność pracy z JAVĄ'],
            ['name' => 'C++', 'description' => 'Umiejętność pracy z C++'],
            ['name' => 'PHP', 'description' => 'Umiejętność pracy z PHP']
        ]);
    }
}
