<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Salon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Registracija vlasnika salona
    public function register(Request $request)
    {
        // Validacija podataka
        $validator = Validator::make($request->all(), [
            'owner_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
        ]);

        // Ako validacija nije prošla, vrati korisniku greške
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Dobavljanje validiranih podataka
        $validated = $validator->validated();

        // Kreiranje korisnika
        $user = User::create([
            'owner_name' => $validated['owner_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        
        // Kreiranje salona i povezivanje sa korisnikom
        $salon = Salon::create([
            'name' => $validated['name'], // Ime salona
            'user_id' => $user->id, // Povezivanje sa korisnikom
        ]);

        // Ako korisnik nije uspešno kreiran
        if (!$user) {
            return redirect()->back()->with('error', 'Došlo je do greške prilikom registracije. Pokušajte ponovo.');
        }

        // Preusmeravanje na stranicu za prijavu sa porukom o uspehu
        return redirect()->route('login')->with('success', 'Uspešno ste se registrovali. Sada se možete prijaviti.');
    }

    // Prikaz forme za logovanje
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Obrada logovanja
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/profile'); // Preusmeravanje na profil
        }
    
        return back()->withErrors([
            'email' => 'Email or password are not correct!',
        ]);
    }

    // Odjava
    public function logout()
    {
        Auth::logout(); // Odjavljuje korisnika
        return redirect('/')->with('success', 'Uspešno ste se odjavili!');
    }
}