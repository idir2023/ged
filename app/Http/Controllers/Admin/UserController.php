<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
  use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs.
     */
    public function index()
    {
        // Charger les utilisateurs avec leurs rôles
        $users = User::with('roles')->paginate(10);
        return view('admin.manage_users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.manage_users.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6' ,
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
    
        $user->assignRole('Super Admin');
    
        return redirect()->route('manage_users.index')->with('success', 'VIP ajouté avec succès.');
    }

    
    public function show(User $user)
    {
        return view('admin.manage_users.show', compact('user'));
    }

    /**
     * Afficher le formulaire d'édition d'un utilisateur.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.manage_users.edit', compact('user', 'roles'));
    }

    /**
     * Mettre à jour un utilisateur existant.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $user->syncRoles([$request->role]);

        return redirect()->route('manage_users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }


    /**
     * Afficher le formulaire de création pour un Chef de Zone.
     */
    public function AddChefZone()
    {
        $zones = \App\Models\Zone::all();
        return view('admin.manage_users.create_chef_zone', compact('zones'));
    }
    
    public function StoreChefZone(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'zone_id' => 'required|exists:zones,id',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'zone_id' => $request->zone_id,
        ]);
    
        $user->assignRole('Chef de Zone');
    
        return redirect()->route('manage_users.index')->with('success', 'Chef de Zone créé avec succès.');
    }
    

    /**
     * Afficher le formulaire de création pour un Chef de Département.
     */
    public function AddChefDepartement()
    {
        $departments = \App\Models\Departement::all();
    return view('admin.manage_users.create_chef_departement', compact('departments'));
    }

    public function StoreChefDepartement(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:6',
        'departement_id' => 'required|exists:departements,id',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'departement_id' => $request->departement_id,
    ]);

    $user->assignRole('Chef de Département');

    return redirect()->route('manage_users.index')->with('success', 'Chef de Département créé avec succès.');
}

public function destroy($id)
{
    $user=user::find($id);
    try {
        // Empêcher la suppression de l'utilisateur connecté
        if (auth()->user()->id === $user->id) {
            return redirect()->route('manage_users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // Vérifier si l'utilisateur est un Super Admin
        if ($user->hasRole('super_admin')) {
            return redirect()->route('manage_users.index')->with('error', 'Vous ne pouvez pas supprimer un Super Admin.');
        }

        // Supprimer les rôles assignés
        $user->roles()->detach();

        // Supprimer l'utilisateur
        $user->delete();

        return redirect()->route('manage_users.index')->with('success', 'Utilisateur supprimé avec succès.');
    } catch (\Exception $e) {
        return redirect()->route('manage_users.index')->with('error', 'Une erreur s\'est produite lors de la suppression.');
    }
}


public function AddChefProjet()
{
    $projects = \App\Models\Project::all();
    return view('admin.manage_users.create_chef_projet', compact('projects'));
}

public function StoreChefProjet(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'phone' => 'required|string|max:20',
        'password' => 'required|string|min:6'  ,
        'project_id' => 'required|exists:projects,id',

     ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'project_id' => $request->project_id,

     ]);

    $user->assignRole('Chef de Projet');

    return redirect()->route('manage_users.index')->with('success', 'Chef de Projet ajouté avec succès.');
}

 


}
