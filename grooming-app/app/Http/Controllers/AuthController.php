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
    //Registracija vlasnika salona
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $user = User::create([
            'owner_name' => $validated['owner_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        
        $salon = Salon::create([
            'name' => $validated['name'],
            'user_id' => $user->id,
        ]);

        if (!$user) {
            return redirect()->back()->with('error', 'Došlo je do greške prilikom registracije. Pokušajte ponovo.');
        }

        return redirect()->route('login')->with('success', 'Uspešno ste se registrovali. Sada se možete prijaviti.');
    }

    //Prikaz forme za logovanje
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //Logovanje
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userId = Auth::id();
            
            return redirect()->route('profile.show', ['id' => $userId]);
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    //Odjava
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Uspešno ste se odjavili!');
    }
}