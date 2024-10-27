<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentCompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student_competence')->insert([
            ['student_id' => 1, 'competence_id' => 1],
            ['student_id' => 1, 'competence_id' => 2],
            ['student_id' => 2, 'competence_id' => 1],
            ['student_id' => 2, 'competence_id' => 2],
            ['student_id' => 2, 'competence_id' => 3],
            ['student_id' => 3, 'competence_id' => 3]
        ]);
    }
}
