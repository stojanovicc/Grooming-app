<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Salon;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        $salon = Salon::where('user_id', $user->id)->first();

        if (!$salon) {
            return redirect()->back()->with('error', 'Nemate povezan salon.');
        }

        return redirect()->route('profile.show', ['id' => $salon->id]);
    }

    //Prikaz profila svim korisnicima
    public function show($id)
    {
        $salon = Salon::with('services')->findOrFail($id);
        $user = User::findOrFail($salon->user_id);

        return view('profile', compact('salon', 'user'));
    }

    //Editovanje informacija koje se prikazuju na profilu iz tabele Salon
    public function edit($id)
    {
        $salon = Salon::findOrFail($id);
        $user = User::findOrFail($salon->user_id);

        if (Auth::id() !== $salon->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('profile.edit', compact('salon', 'user'));
    }

    //Azuriranje informacija koje se prikazuju na profilu iz tabele Salon
    public function update(Request $request, $id)
    {
        $salon = Salon::findOrFail($id);

        if (Auth::id() !== $salon->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'owner_name' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'area' => 'nullable|string',
            'profile_image_url' => 'nullable|url',
        ]);

        // Ažuriramo podatke salona
        $salon->phone = $validated['phone'] ?? $salon->phone;
        $salon->city = $validated['city'] ?? $salon->city;
        $salon->address = $validated['address'] ?? $salon->address;
        $salon->area = $validated['area'] ?? $salon->area;
        $salon->profile_image_url = $validated['profile_image_url'] ?? $salon->profile_image_url;
        $salon->save();

        // Ažuriranje imena, prezimena i email-a vlasnika salona
        $user = User::findOrFail($salon->user_id);
        $user->owner_name = $validated['owner_name'] ?? $user->owner_name;
        $user->email = $validated['email'] ?? $user->email;
        $user->save();
        
        return redirect()->route('profile.show', ['id' => $salon->id])->with('success', 'Podaci su uspešno ažurirani.');
    }
}
    // Brisanje korisničkog naloga
    // public function deleteAccount()
    // {
    //     $user = Auth::user();
    //     $user->delete();

    //     Auth::logout();