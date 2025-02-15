<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
}
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChefDeDepartement;

class ChefAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.chef-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_chef' => 'required|email',
            'mot_de_passe_chef_projet' => 'required|string|min:6',
        ]);

        // 🔥 Tentative de connexion avec email et mot de passe
        $chef = ChefDeDepartement::where('email_chef', $request->email_chef)
            ->where('mot_de_passe_chef_projet', $request->mot_de_passe_chef_projet)
            ->first();

        if ($chef) {
            Auth::guard('chef')->login($chef);
            return redirect()->route('chef.dashboard')->with('success', 'Connexion réussie');
        }

        return back()->withErrors(['email_chef' => 'Email ou mot de passe incorrect.']);
    }

    public function logout()
    {
        Auth::guard('chef')->logout();
        return redirect()->route('chef.login')->with('success', 'Déconnexion réussie.');
    }
}

