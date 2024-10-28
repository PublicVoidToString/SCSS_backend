<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employer')->insert([
            ['company_name' => 'Lethal Company', 'krs_number' => 123456789],
            ['company_name' => 'Meta', 'krs_number' => 987654321],
            ['company_name' => 'Musk', 'krs_number' => 112233445]
        ]);
    }
}
