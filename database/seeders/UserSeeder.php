<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        User::create([
            // 'name' => 'DigitalAdmin',
            'email' => 'dgicadmin@mm.com',
            'password' => bcrypt('password') ,
            'user_role' => 'admin'
        ]);

        // Create regular user(s)
        // ...
    }
}

