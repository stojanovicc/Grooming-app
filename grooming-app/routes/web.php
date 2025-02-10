<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalonController;

Route::get('/', function () {
    return view('home');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

// Rute za LogIn i LogOut
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Ruta za prijavu
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Ruta za odjavu
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta za prikaz javnog profila salona
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

// Privatne rute za vlasnika salona (zahtevaju autentifikaciju)
Route::middleware('auth')->group(function () {
    // Ruta za prikaz stranice za izmenu profila
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Ruta za ažuriranje podataka o profilu
    Route::post('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');

    // (Opcionalno) Ruta za brisanje profila, ako je potrebno
    // Route::post('/profile/{id}/delete', [ProfileController::class, 'delete'])->name('profile.delete');
});