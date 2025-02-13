<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Salon;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function store(Request $request, $id)
    {
        $salon = Salon::findOrFail($id);

        if (auth()->id() !== $salon->user_id) {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('galleries', 'public');

        $salon->galleries()->create([
            'image_path' => $imagePath,
        ]);

        return redirect()->route('profile.show', $salon->id)->with('success', 'Slika je uspešno dodata.');
    }

    public function destroy($id, Gallery $gallery)
    {
        $salon = Salon::findOrFail($id);

        if (auth()->id() !== $salon->user_id) {
            abort(403, 'Nemate dozvolu za ovu akciju.');
        }

        \Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('profile.show', $salon->id)->with('success', 'Slika je uspešno obrisana.');
    }
}
