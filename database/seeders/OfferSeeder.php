<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offer')->insert([
            ['employer_id' => 1, 'title' => 'Developer C++', 'description' => 'Opis oferty 1', 'expiration_date' => '2023-12-31'],
            ['employer_id' => 2, 'title' => 'Developer Java', 'description' => 'Opis oferty 2', 'expiration_date' => '2023-12-31'],
            ['employer_id' => 3, 'title' => 'Developer PHP', 'description' => 'Opis oferty 3', 'expiration_date' => '2023-12-31']
        ]);
    }
}
