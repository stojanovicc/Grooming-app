<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Salon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Prikaz svih recenzija za određeni salon
    public function index($salonId)
    {
        $salon = Salon::with('reviews')->findOrFail($salonId);

        return view('reviews.index', compact('salon'));
    }

    // Prikaz forme za dodavanje recenzije
    public function create($salonId)
    {
        $salon = Salon::findOrFail($salonId);

        return view('reviews.create', compact('salon'));
    }

    // Čuvanje nove recenzije
    public function store(Request $request, $salon_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'salon_id' => $salon_id,
        ]);

        return redirect()->route('reviews.index', $salon_id)->with('success', 'Review added successfully!');
    }
}