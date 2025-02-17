<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // Charger les utilisateurs avec leurs rôles
        $users = User::with('roles')->paginate(10);

        return view('admin.manage_users.index', compact('users'));
    }
}

