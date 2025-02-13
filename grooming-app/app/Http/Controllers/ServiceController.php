<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Salon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Prikaz profila salona sa uslugama
    public function show($id)
    {
        $salon = Salon::with('services')->findOrFail($id);

        return view('profile', compact('salon'));
    }

    // Prikaz forme za dodavanje usluge
    public function create($id)
    {
        $salon = Salon::findOrFail($id);

        if (auth()->id() !== $salon->user_id) {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }

        return view('services.create', compact('salon'));
    }

    // Čuvanje usluge u bazu
    public function store(Request $request, $id)
    {
        $salon = Salon::findOrFail($id);

        if (auth()->id() !== $salon->user_id) {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
        ]);

        $salon->services()->create($request->only('name', 'price', 'duration'));

        return redirect()->route('profile.show', $salon->id)->with('success', 'Usluga je uspešno dodata.');
    }

    public function edit($id, $serviceId)
    {
        $salon = Salon::findOrFail($id);
        $service = Service::findOrFail($serviceId);

        if (auth()->id() !== $salon->user_id) {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }

        return view('services.edit', compact('salon', 'service'));
    }

    public function update(Request $request, $id, $serviceId)
    {
        $salon = Salon::findOrFail($id);
        $service = Service::findOrFail($serviceId);

        if (auth()->id() !== $salon->user_id) {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
        ]);

        $service->update($request->only('name', 'price', 'duration'));

        return redirect()->route('profile.show', $salon->id)->with('success', 'Usluga je uspešno izmenjena.');
    }

    //Brisanje usluge u salonu
    public function destroy($id, $serviceId)
    {
        $salon = Salon::findOrFail($id);
        $service = Service::findOrFail($serviceId);

        if (auth()->id() !== $salon->user_id) {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }

        $service->delete();

        return redirect()->route('profile.show', $salon->id)->with('success', 'Usluga je uspešno obrisana.');
    }
}
