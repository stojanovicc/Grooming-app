<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salon;

class SalonController extends Controller
{
    //Prikaz svih salona u bazi i pretraga salona po nazivu, gradu i podrucju
    public function index(Request $request)
    {
        $query = \App\Models\Salon::query();

        // Pretraga po nazivu
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Pretraga po gradu
        if ($request->filled('city')) {
            $query->where('city', $request->city);

            // Ako je uneto područje, pretraži unutar izabranog grada
            if ($request->filled('area')) {
                $query->where('area', 'like', '%' . $request->area . '%');
            }
        } elseif ($request->filled('area')) {
            // Ako je uneto područje bez grada, izbaci grešku ili prikaži poruku
            return redirect()->route('salons.index')
                ->with('error', 'Molimo unesite grad za pretragu područja.');
        }

        // Dobavljanje rezultata
        $salons = $query->get();

        // Ako nema rezultata, prikazujemo poruku
        $message = null;
        if ($salons->isEmpty()) {
            $message = "Nema rezultata za ovu pretragu.";
        }

        return view('salons.index', compact('salons', 'message'));
    }

}
