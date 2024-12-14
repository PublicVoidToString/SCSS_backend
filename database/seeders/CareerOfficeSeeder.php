<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CareerOffice;
use App\Models\EducationMaterials;
use Illuminate\Support\Facades\Hash;

class CareerOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $careerOffices = [
            ['university' => 'Uniwersytet Warszawski'],
            ['university' => 'UMG'],
            ['university' => 'Uniwersytet Jagielloński']
        ];

        foreach ($careerOffices as $office) {
            $careerOffice = CareerOffice::create($office);

            // Create a User for the Career Office
            $user = new User();
            $user->email = strtolower(str_replace(' ', '_', $office['university'])) . '@career.com';
            $user->password = Hash::make('password123');
            $user->role_id = User::ROLE_CAREEROFFICE;
            $user->data_id = $careerOffice->id;
            $user->save();

            // Assign a blog instance
            EducationMaterials::create([
                'career_office_id' => $careerOffice->id,
                'title' => $office['university'] . " Blog",
                'description' => "Witaj w blogu " . $office['university']
            ]);
        }
    }
}
