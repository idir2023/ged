<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    HomeController,
    ProfileController,
    ContactController,
    DepartementController,
    UserController,
    ZoneController,
    ProjectController
};
use Spatie\Permission\Models\Role;

// Redirection vers la page de login par défaut
Route::get('/', function() {
    return view('auth.login');
})->name('login');

// Routes d'authentification
Auth::routes();

// Dashboard Routes (Require Authentication)
Route::group(["prefix" => 'dashboard', "middleware" => ['auth']], function () {
    
    // Profile utilisateur (Accessible à tous les utilisateurs connectés)
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // 🌟 **Admin & Managers Only (Super Admin, Chef de Département, Chef de Zone)**
    Route::group(['middleware' => ['role:Super Admin|Chef de Département|Chef de Zone']], function () {
        
        // Accueil Admin
        Route::get('/', [HomeController::class, 'root'])->name('root');

        // Gestion des utilisateurs (Super Admin & Chef de Département)
        Route::group(['middleware' => ['role:Super Admin|Chef de Département']], function () {
            Route::get('/add-user', [ProfileController::class, 'addUser'])->name('add.user');
            Route::post('/store-user', [ProfileController::class, 'store'])->name('users.store');
            Route::resource('manage_users', UserController::class);
        });

        // Ajouter des chefs (Super Admin only)
        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::get('/add_chef_departement', [UserController::class, 'AddChefDepartement'])->name('AddChefDepartement');
            Route::get('/add_chef_zone', [UserController::class, 'AddChefZone'])->name('AddChefZone');
            Route::get('/chef-projet', [UserController::class, 'AddChefProjet'])->name('AddChefProjet');

            Route::post('/chef-departement', [UserController::class, 'StoreChefDepartement'])->name('StoreChefDepartement');
            Route::post('/chef-zone', [UserController::class, 'StoreChefZone'])->name('StoreChefZone');
            Route::post('/chef-projet', [UserController::class, 'StoreChefProjet'])->name('StoreChefProjet');
        });

        // Gestion des contacts (Super Admin & Chef de Département)
        Route::group(['middleware' => ['role:Super Admin|Chef de Département']], function () {
            Route::resource("contact", ContactController::class);
        });

        // Gestion des départements et des zones (Super Admin & Chef de Département & Chef de Zone)
        Route::resource('departements', DepartementController::class);
        Route::resource('zones', ZoneController::class);

        // Gestion des projets (Accessible par les chefs de projet)
        Route::group(['middleware' => ['role:Super Admin|Chef de Projet']], function () {
            Route::resource('projects', ProjectController::class);
        });

    });

});

// Changer la langue
Route::get('/index/{locale}', [HomeController::class, 'lang']);

// Gestion des fichiers temporaires
Route::post('/store-temp-file', [HomeController::class, 'storeTempFile'])->name('storeTempFile');
Route::post('/delete-temp-file', [HomeController::class, 'deleteTempFile'])->name('deleteTempFile');

// Sandbox: récupération d'un client aléatoire (pour tests)
Route::get('/get-random-customer', [HomeController::class, 'randomCustomer'])->name('randomCustomer');
