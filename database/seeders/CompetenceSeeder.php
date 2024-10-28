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
            ['name' => 'JAVA', 'description' => 'Doświadczenie w pracu z JAVĄ'],
            ['name' => 'C++', 'description' => 'Doświadczenie w pracu z C++'],
            ['name' => 'PHP', 'description' => 'Doświadczenie w pracu z PHP']
        ]);
    }
}
