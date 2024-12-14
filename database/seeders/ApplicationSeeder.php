<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('applications')->insert([
            // Applications for offer 1 (Developer C++)
            ['student_id' => 1, 'offer_id' => 1, 'cv' => 'cv_student_1.pdf'],
            ['student_id' => 2, 'offer_id' => 1, 'cv' => 'cv_student_2.pdf'],
            ['student_id' => 3, 'offer_id' => 1, 'cv' => 'cv_student_3.pdf'],

            // Applications for offer 2 (Developer Java)
            ['student_id' => 1, 'offer_id' => 2, 'cv' => 'cv_student_1_java.pdf'],
            ['student_id' => 2, 'offer_id' => 2, 'cv' => 'cv_student_2_java.pdf'],
            ['student_id' => 3, 'offer_id' => 2, 'cv' => 'cv_student_3_java.pdf'],

            // Applications for offer 3 (Developer PHP)
            ['student_id' => 1, 'offer_id' => 3, 'cv' => 'cv_student_1_php.pdf'],
            ['student_id' => 2, 'offer_id' => 3, 'cv' => 'cv_student_2_php.pdf'],
            ['student_id' => 3, 'offer_id' => 3, 'cv' => 'cv_student_3_php.pdf']
        ]);
    }
}