<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActiviteSportifController;
use App\Http\Controllers\HoraireController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommandeController;

/*
|--------------------------------------------------------------------------
| WELCOME / PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/decouvrir-le-club', function () {
    return view('decouvrir');
})->name('club.decouvrir');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('is_admin')->name('admin.dashboard');

    Route::get('/user/dashboard', function () {
        return view('User.dashboard');
    })->name('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (CRUD PROTÉGÉ)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('activiteSportif', ActiviteSportifController::class)->except(['index', 'show']);
    Route::resource('produit', ProduitController::class)->except(['index', 'show']);
    Route::resource('users', UserController::class)->except(['show', 'edit', 'update']);
    Route::resource('commandes', CommandeController::class)->except(['index', 'create', 'store', 'show']); // admin a show via controller
    Route::resource('reservation', ReservationController::class)->except(['create', 'store', 'index', 'show']);

    // Horaires avec routes manuelles pour éviter show
    Route::get('horaire/create/{activiteSportif}', [HoraireController::class, 'create'])->name('horaire.create');
    Route::post('horaire', [HoraireController::class, 'store'])->name('horaire.store');
    Route::get('horaire/{horaire}/edit', [HoraireController::class, 'edit'])->name('horaire.edit');
    Route::put('horaire/{horaire}', [HoraireController::class, 'update'])->name('horaire.update');
    Route::delete('horaire/{horaire}', [HoraireController::class, 'destroy'])->name('horaire.destroy');
});

/*
|--------------------------------------------------------------------------
| USER ROUTES (PROTÉGÉES)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profil utilisateur
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    // Activités pour tous les utilisateurs
    Route::get('/activites', [ActiviteSportifController::class, 'index'])->name('activiteSportif.index');
    Route::get('/activites/{id}', [ActiviteSportifController::class, 'show'])->name('activiteSportif.show');

    // Réservations utilisateur
    Route::get('/reservation/create/{activite_id}', [ReservationController::class, 'create'])->name('Reservation.create');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('Reservation.store');
    Route::get('/reservation', [ReservationController::class, 'index'])->name('Reservation.index');
    Route::get('/reservation/{id}', [ReservationController::class, 'show'])->name('Reservation.show');

    // Produits pour utilisateurs normaux
    Route::get('/produits', [ProduitController::class, 'index'])->name('produit.index');
    Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produit.show');

    // Commandes utilisateur
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
    Route::get('/commandes/{id}', [CommandeController::class, 'show'])->name('commandes.show');
    // Formulaire pour passer une commande pour un produit donné
Route::get('/commandes/create/{produit}', [CommandeController::class, 'create'])->name('commande.create');
 // controller vérifie le propriétaire

    // Horaires accessibles aux utilisateurs normaux
    Route::get('/horaire', [HoraireController::class, 'index'])->name('horaire.index');
});
