<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
 
class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('roles')->select(['id', 'name', 'email']);
    
            return DataTables::of($users)
                ->addColumn('photo', function ($user) {
                    return '<img src="' . ($user->getFirstMediaUrl('avatars') ?: asset('default-avatar.png')) . '" class="img-thumbnail" width="50">';
                })
                ->addColumn('role', function ($user) {
                    return $user->roles->pluck('name')->implode(', '); // Display multiple roles
                })
                ->addColumn('action', function ($user) {
                    $editUrl = route('manage_users.edit', $user->id);
                    $deleteUrl = route('manage_users.destroy', $user->id);
    
                    return '
                        <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                            <i class="bx bx-edit"></i> Modifier
                        </a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Confirmer la suppression ?\')">
                                <i class="bx bx-trash"></i> Supprimer
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);
        }
    
        return view('admin.manage_users.index');
    }
    

    public function create()
    {
        $roles = Role::all(); // Fetch all roles
        return view('admin.manage_users.create', compact('roles'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'role' => 'required|exists:roles,name',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole($request->role);

    if ($request->hasFile('avatar')) {
        $user->addMedia($request->file('avatar'))->toMediaCollection('avatars');
    }

    return redirect()->route('manage_users.index')->with('success', 'Utilisateur ajouté avec succès.');
}




public function edit(User $manage_user)
{
    $roles = Role::all();
    return view('admin.manage_users.edit', compact('manage_user', 'roles'));
}


public function update(Request $request, User $manage_user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $manage_user->id,
        'role' => 'required|exists:roles,name',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->only(['name', 'email']);

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $manage_user->update($data);
    $manage_user->syncRoles([$request->role]);

    if ($request->hasFile('avatar')) {
        $manage_user->clearMediaCollection('avatars');
        $manage_user->addMedia($request->file('avatar'))->toMediaCollection('avatars');
    }

    return redirect()->route('manage_users.index')->with('success', 'Utilisateur mis à jour avec succès.');
}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('manage_users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
