<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $administratorData = \App\Models\Administrator::create([]);
                
        $user = new User();
        $user->email = "admin@admin.com";
        $user->password = Hash::make("admin123");
        $user->role_id = User::ROLE_ADMINISTRATOR;
        $user->data_id = $administratorData->id;
        
        $user->save();
    }
}
