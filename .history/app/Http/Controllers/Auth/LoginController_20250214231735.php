<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo()
    {
        if (Auth::user()->is_admin) {
            return route('root');
        } else {
            return route('profile');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChefDeDepartement;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     */
    public function redirectTo()
    {
        // 🔥 Vérifier si l'utilisateur est un chef de département
        if (Auth::guard('chef')->check()) {
            return route('chef.dashboard'); // Rediriger vers le tableau de bord des chefs
        }

        // 🔥 Si l'utilisateur est un administrateur (users)
        if (Auth::user() && Auth::user()->is_admin) {
            return route('root');
        }

        // 🔥 Sinon, rediriger vers son profil (utilisateur normal)
        return route('profile');
    }

    /**
     * Fonction pour identifier si l'utilisateur est un Admin ou un Chef de Département
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // 🔹 Tentative de connexion pour les admins
        if (Auth::attempt($credentials)) {
            return redirect()->intended($this->redirectTo());
        }

        // 🔹 Tentative de connexion pour les chefs de département
        $chef = ChefDeDepartement::where('email_chef', $request->email)
                                 ->where('mot_de_passe_chef_projet', $request->password)
                                 ->first();

        if ($chef) {
            Auth::guard('chef')->login($chef);
            return redirect()->route('chef.dashboard');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    /**
     * Fonction de déconnexion
     */
    public function logout(Request $request)
    {
        if (Auth::guard('chef')->check()) {
            Auth::guard('chef')->logout();
            return redirect()->route('chef.login')->with('success', 'Déconnexion réussie.');
        }

        Auth::logout();
        return redirect('/login')->with('success', 'Déconnexion réussie.');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

}
