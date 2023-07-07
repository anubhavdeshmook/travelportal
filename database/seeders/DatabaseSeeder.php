<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $userData = [
            [
                'name'=>'Admin',
                'email'=>'admin@dotsquares.com',
                'is_admin'=>'1',
                'password'=> bcrypt('Dots@123'),
            ],
            [
                'name'=>'Regular User',
                'email'=>'reguser@gmail.com',
                'is_admin'=>'0',
                'password'=> bcrypt('Dots@123'),
            ],
        ];
  
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
