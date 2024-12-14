<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        $user->password = Hash::make("password123");
        $user->role_id = User::ROLE_ADMINISTRATOR;
        $user->data_id = $administratorData->id;
        
        $user->save();
    }
}
