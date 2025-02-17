<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder {
    public function run() {
        // Création des rôles
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $chefDepartement = Role::create(['name' => 'Chef de Département']);
        $chefZone = Role::create(['name' => 'Chef de Zone']);
        $chefProjet = Role::create(['name' => 'Chef de Projet']);
        $employe = Role::create(['name' => 'Employé']);

        // Permissions de base
        $permissions = [
            'manage users', 'manage projects', 'manage documents',
            'view documents', 'edit documents', 'delete documents'
        ];

        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assignation des permissions aux rôles
        $superAdmin->givePermissionTo(Permission::all());
        $chefDepartement->givePermissionTo(['manage users', 'manage documents']);
        $chefZone->givePermissionTo(['manage projects', 'view documents']);
        $chefProjet->givePermissionTo(['manage documents', 'view documents']);
        $employe->givePermissionTo(['view documents']);
    }
}
