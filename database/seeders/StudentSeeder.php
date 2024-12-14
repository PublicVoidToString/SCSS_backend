<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the students
        $students = [
            ['name' => 'Jan', 'surname' => 'Kowalski', 'indexnumber' => '12345', 'description' => 'Opis studenta 1'],
            ['name' => 'Anna', 'surname' => 'Nowak', 'indexnumber' => '67890', 'description' => 'Opis studenta 2'],
            ['name' => 'Piotr', 'surname' => 'Wiśniewski', 'indexnumber' => '11223', 'description' => 'Opis studenta 3']
        ];

        foreach ($students as $studentData) {
            $student = Student::create($studentData);

            // Create a User for the Career Office
            $user = new User();
            $user->email = strtolower($studentData['name'] . '@student.com');
            $user->password = Hash::make('password123');
            $user->role_id = User::ROLE_STUDENT;
            $user->data_id = $student->id;
            $user->save();
        }
    }
}
