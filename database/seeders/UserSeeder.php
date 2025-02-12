<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin 
        User::firstOrCreate(
            [
                "email" => "admin@airline.com",
                "name" => "admin",
                "phone" => '0123456789',
            ],
            [
                'is_admin' => true,
                "password" => bcrypt("password",)
            ]
        );

    }
}
