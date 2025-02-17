<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\Admin\{
    HomeController,
    ProfileController,
    ContactController,
    DepartementController,
    ChefDeDepartementController,
    UserController,
    ZoneController
};
use Spatie\Permission\Models\Role;


// Redirection vers la page de login par défaut
Route::get('/', function() {
    return view('auth.login');
})->name('login');

// Routes d'authentification
Auth::routes();

// Dashboard
Route::group(["prefix" => 'dashboard', "middleware" => ['auth']], function () {
    
    // Profile utilisateur
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // Routes accessibles uniquement aux administrateurs
    Route::group(['middleware' => ['role:Super Admin']], function () {
        
        // Accueil Admin
        Route::get('/', [HomeController::class, 'root'])->name('root');

        // Gestion des utilisateurs
        Route::get('/add-user', [ProfileController::class, 'addUser'])->name('add.user');
        Route::post('/store-user', [ProfileController::class, 'store'])->name('users.store');
        Route::resource('manage_users', UserController::class);

        // Gestion des contacts
        Route::resource("contact", ContactController::class);

        // Gestion des départements et des zones
        Route::resource('departements', DepartementController::class);
        Route::resource('zones', ZoneController::class);
    });

});

// Changer la langue
Route::get('/index/{locale}', [HomeController::class, 'lang']);

// Gestion des fichiers temporaires
Route::post('/store-temp-file', [HomeController::class, 'storeTempFile'])->name('storeTempFile');
Route::post('/delete-temp-file', [HomeController::class, 'deleteTempFile'])->name('deleteTempFile');

// Sandbox: récupération d'un client aléatoire (pour tests)
Route::get('/get-random-customer', [HomeController::class, 'randomCustomer'])->name('randomCustomer');

// Catch-All Route pour éviter les erreurs 404 (Mettre en dernier pour ne pas interférer avec les autres routes)
Route::get('/{any}', [HomeController::class, 'index'])->where('any', '.*')->name('index');
