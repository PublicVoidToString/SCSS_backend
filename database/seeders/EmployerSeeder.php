<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employer;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competences = [
            ['name' => 'FRONTEND', 'description' => 'Znajomość pracy na frontendzie aplikacji'],
            ['name' => 'BACKEND', 'description' => 'Umiejętność pracy na backendzie aplikacji'],
            ['name' => 'DEVOPS', 'description' => 'Umiejętności devops'],
            ['name' => 'DATA SCIENCE', 'description' => 'Umiejętności pracy na big data'],
            ['name' => 'CYBER SECURITY', 'description' => 'Umiejętności cyber security'],
            ['name' => 'JAVA', 'description' => 'Umiejętność pracy z JAVĄ'],
            ['name' => 'C++', 'description' => 'Umiejętność pracy z C++'],
            ['name' => 'PHP', 'description' => 'Umiejętność pracy z PHP']
        ];

        DB::table('competence')->insert($competences);

        $employers = [
            ['companyname' => 'Lethal Company', 'krsnumber' => 123456789],
            ['companyname' => 'Meta', 'krsnumber' => 987654321],
            ['companyname' => 'Musk', 'krsnumber' => 112233445]
        ];

        foreach ($employers as $index => $employerData) {
            $employer = Employer::create($employerData);

            // Create a User for the Employer
            $user = new User();
            $user->email = strtolower(str_replace(' ', '_', $employerData['companyname'])) . '@employer.com';
            $user->password = Hash::make('password123');
            $user->role_id = User::ROLE_EMPLOYER;
            $user->data_id = $employer->id;
            $user->save();

            // Add an offer for each employer
            $offer = Offer::create([
                'employer_id' => $employer->id,
                'title' => "Okazja pracy w " . $employerData['companyname'],
                'description' => "Join " . $employerData['companyname'] . " for an exciting career!",
                'expiration_date' => now()->addMonths(3)
            ]);

            $programmingSkills = [6, 7, 8]; // id dla języków programowania 'JAVA', 'C++', 'PHP'
            $types = [1, 2, 3, 4, 5]; // id dla ścieżek karier 'FRONTEND', 'BACKEND' itp

            $selectedProgrammingSkill = $programmingSkills[$index % count($programmingSkills)];
            $selectedType = $types[$index % count($types)];

            DB::table('offer_competence')->insert([
                ['offer_id' => $offer->id, 'competence_id' => $selectedProgrammingSkill],
                ['offer_id' => $offer->id, 'competence_id' => $selectedType]
            ]);
        }
    }
}
