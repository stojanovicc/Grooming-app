<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Salon;

class ProfileController extends Controller
{
    //Prikaz salona
    public function show($id)
    {
        $salon = Salon::findOrFail($id);

        return view('salons.show', compact('salon'));
    }

    // Glavna stranica profila
    public function index()
    {
        $user = auth()->user();
        $salon = $user->salon;

        return view('profile', [
            'user' => $user,
            'salon' => $salon,
            'viewMode' => 'overview'
        ]);
    }

    //Ucitavanje profilne slike
    public function updateImage(Request $request)
    {
        $user = auth()->user();

        // Validacija URL-a slike
        $request->validate([
            'profile_image_url' => 'nullable|url',
        ]);

        // Ažuriranje URL-a slike u bazi
        if ($request->has('profile_image_url')) {
            $user->profile_image_url = $request->input('profile_image_url');
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'Profilna slika je uspešno ažurirana.');
    }

    // Stranica za postavke
    public function settings($id)
    {
        $user = Auth::user();

        if ($user->id != $id) {
            abort(403, 'Nemate pristup ovoj stranici.');
        }

        return view('profile.settings', compact('user'));
    }

    // Forma za uređivanje profila
    public function edit($id)
    {
        $profile = User::findOrFail($id);

        if (auth()->id() !== $profile->user_id) {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }

        return view('profile.edit', compact('profile'));
    }

    // Ažuriranje profila
    public function update(Request $request, $id)
    {
        if (Auth::id() != $id) {
            return redirect()->route('profile')->withErrors('Možeš da ažuriraš samo svoj profil.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));

        return redirect()->route('profile')->with('success', 'Profil je uspešno ažuriran!');
    }

    // // Stranica za prikaz javnog profila
    // public function show($id)
    // {
    //     $user = User::findOrFail($id);
    //     $salon = $user->salon;

    //     return view('profile', [
    //         'user' => $user,
    //         'salon' => $salon,
    //         'viewMode' => 'public'
    //     ]);
    // }

    // Brisanje korisničkog naloga
    public function deleteAccount()
    {
        $user = Auth::user();
        $user->delete();

        Auth::logout();

        return redirect('/login')->with('status', 'Tvoj nalog je trajno obrisan.');
    }

    //Prikaz usluga salona od strane vlasnika salona
    public function showProfile()
    {
        $user = auth()->user();
        $salon = $user->salon;

        $viewMode = 'overview'; 

        return view('profile', compact('user', 'salon', 'viewMode'));
    }


    //azuriranje usluga u salonu od strane vlasnika
    public function updateServices(Request $request)
    {
        $request->validate([
            'services' => 'required|string|max:5000',
        ]);

        $salon = auth()->user()->salon;
        if (!$salon) {
            return redirect()->back()->with('error', 'Salon nije pronađen.');
        }

        $salon->services = $request->input('services');
        $salon->save();

        return redirect()->route('profile')->with('success', 'Usluge su uspešno ažurirane.');
    }

    public function editServices()
    {
        return view('profile.edit-services');
    }
}
