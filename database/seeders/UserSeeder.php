<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Ensure roles exist before assigning them
        $roles = ['admin', 'chef_zone', 'chef_departement', 'chef_projet', 'employee'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create Admin User
        $admin = User::firstOrCreate(
            [
                "email" => "admin@airline.com",
            ],
            [
                "name" => "Admin",
                "phone" => '0123456789',
                "is_admin" => true,
                "password" => Hash::make("password"), // Secure password hashing
            ]
        );

        // Assign "admin" role
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
    }
}
