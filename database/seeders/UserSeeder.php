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
        // Vérifier si le rôle "Super Admin" existe, sinon le créer
        $adminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);

        // Créer ou mettre à jour l'utilisateur Admin
        $admin = User::updateOrCreate(
            [
                "email" => "admin@airline.com",
            ],
            [
                "name" => "Super Admin",
                "phone" => '0123456789',
                "password" => Hash::make("password"), // Hachage sécurisé
            ]
        );

        // Assigner le rôle "Super Admin" à l'utilisateur
        if (!$admin->hasRole('Super Admin')) {
            $admin->assignRole($adminRole);
        }
    }
}
