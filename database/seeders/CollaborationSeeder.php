<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollaborationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('collaboration')->insert([
            ['careeroffice_id' => 1, 'employer_id' => 1],
            ['careeroffice_id' => 2, 'employer_id' => 2],
            ['careeroffice_id' => 3, 'employer_id' => 3]
        ]);
    }
}
