<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('student')->insert([
            ['name' => 'Jan', 'surname' => 'Kowalski', 'indexnumber' => '12345', 'description' => 'Opis studenta 1'],
            ['name' => 'Anna', 'surname' => 'Nowak', 'indexnumber' => '67890', 'description' => 'Opis studenta 2'],
            ['name' => 'Piotr', 'surname' => 'Wiśniewski', 'indexnumber' => '11223', 'description' => 'Opis studenta 3']
        ]);
    }
}
