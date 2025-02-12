<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GalleryController;

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
    // Ruta za prikaz privatnog profila (ulogovanog korisnika)
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.showProfile');
    
    //Rute za INFORMACIJE SALONA:
    // Ruta za prikaz stranice za izmenu profila
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Ruta za ažuriranje podataka o profilu
    Route::post('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');

    //Rute za USLUGE:
    //Rute za dodavanje i pamcenje usluga u salonu
    Route::get('/profile/{id}/createServices', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/profile/{id}/storeServices', [ServiceController::class, 'store'])->name('services.store');
    //Rute za izmenu i pamcenje usluga u salonu
    Route::get('/profile/{id}/editService/{serviceId}', [ServiceController::class, 'edit'])->name('services.edit');
    Route::post('/profile/{id}/updateService/{serviceId}', [ServiceController::class, 'update'])->name('services.update');
    //Ruta za brisanje usluge u salonu
    Route::delete('/profile/{id}/deleteService/{serviceId}', [ServiceController::class, 'destroy'])->name('services.destroy');

    //Rute za GALERIJU SLIKA:
    Route::post('/profile/{id}/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::delete('/profile/{id}/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
});
    // (Opcionalno) Ruta za brisanje profila, ako je potrebno
    // Route::post('/profile/{id}/delete', [ProfileController::class, 'delete'])->name('profile.delete');

//Ruta za prikaz svih salona
Route::get('/salons', [SalonController::class, 'index'])->name('salons.index');

Route::get('salons/{salonId}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('salons/{salonId}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('salons/{salonId}/reviews', [ReviewController::class, 'store'])->name('reviews.store');