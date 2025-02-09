<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalonController;

//Ruta za prikaz svih salona koji su u bazi podataka
Route::get('/salons', [SalonController::class, 'index'])->name('salons.index');

//Ruta za prikaz salona sa konkretnim ID
Route::get('/salons/{id}', [SalonController::class, 'show'])->name('salons.show');


Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

// Ruta za prikaz forme za logovanje
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Ruta za prijavu
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Ruta za odjavu
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Javni prikaz salona (dostupno svima, uključujući goste)
// Route::get('/salons/{id}', [ProfileController::class, 'show'])->name('salons.show');

// Privatne rute za vlasnika salona (zahtevaju autentifikaciju)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile'); // Trenutni profil vlasnika
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Forma za uređivanje
    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update'); // Ažuriranje profila
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::get('/profile/services/edit', [ProfileController::class, 'editServices'])->name('profile.services.edit');
    Route::post('/profile/services/update', [ProfileController::class, 'updateServices'])->name('profile.update.services');
    Route::post('/profile', [ProfileController::class, 'updateImage'])->name('profile.updateImage');
    Route::post('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete'); // Brisanje naloga

});

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return redirect('/profile');
})->name('home');

//Rute za usluge salona
Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
});

