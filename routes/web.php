<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActiviteSportifController;
use App\Http\Controllers\HoraireController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommandeController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// Page login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Page register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD ROUTES
|--------------------------------------------------------------------------
*/

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Dashboard User
Route::get('/user/dashboard', function () {
    return view('User.dashboard');
})->name('user.dashboard');



// -------------------- ADMIN ROUTES --------------------
// Activité Sportive
Route::resource('activiteSportif', ActiviteSportifController::class);

// Horaires
Route::resource('horaire', HoraireController::class);

// Produits
Route::resource('produit', ProduitController::class);

// Réservations admin (pas de create/store)
Route::resource('reservation', ReservationController::class)->except(['create', 'store']);

// Utilisateurs
Route::resource('users', UserController::class);

// Commandes
Route::resource('commandes', CommandeController::class);


// -------------------- USER ROUTES --------------------
// Activité Sportive : voir seulement
Route::get('activiteSportif', [ActiviteSportifController::class, 'index'])->name('activiteSportif.index');
Route::get('activiteSportif/{id}', [ActiviteSportifController::class, 'show'])->name('activiteSportif.show');

// Réservation : créer et voir
Route::get('reservation/create/{activite_id}', [ReservationController::class, 'create'])->name('Reservation.create');
Route::post('reservation', [ReservationController::class, 'store'])->name('Reservation.store');
Route::get('reservation', [ReservationController::class, 'index'])->name('Reservation.index');
Route::get('reservation/{id}', [ReservationController::class, 'show'])->name('Reservation.show');
