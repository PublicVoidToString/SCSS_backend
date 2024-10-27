<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferCompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offer_competence')->insert([
            ['offer_id' => 1, 'competence_id' => 2],
            ['offer_id' => 2, 'competence_id' => 1],
            ['offer_id' => 3, 'competence_id' => 3]
        ]);
    }
}
