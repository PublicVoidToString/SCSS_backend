<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CareerOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('career_office')->insert([
            ['university' => 'Uniwersytet Warszawski'],
            ['university' => 'UMG'],
            ['university' => 'Uniwersytet Jagielloński']
        ]);
    }
}
