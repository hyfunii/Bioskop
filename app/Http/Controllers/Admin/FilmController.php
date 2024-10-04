<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::with('genre')->get();
        return view('admin.film.home', compact('films'));
    }

    public function show($id)
    {
        $film = Film::findOrFail($id);
        return view('admin.film.detail_film', compact('film'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.film.create_film', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:films,name',
            'genre_id' => 'required|exists:genres,genre_id',
            'director' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'duration' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Film::create([
            'name' => $request->name,
            'genre_id' => $request->genre_id,
            'director' => $request->director,
            'synopsis' => $request->synopsis,
            'duration' => $request->duration,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.home')->with('success', 'Film created successfully.');
    }

    public function edit($id)
    {
        $film = Film::findOrFail($id);
        $genres = Genre::all();
        return view('admin.film.edit_film', compact('film', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,genre_id',
            'director' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'duration' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk gambar baru
        ]);

        $film = Film::findOrFail($id);

        // Simpan gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($film->image) {
                $oldImagePath = public_path('images/' . $film->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Hapus gambar lama
                }
            }

            // Upload gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $film->image = $imageName; // Update kolom image di database
        }

        // Update data film lainnya
        $film->name = $request->name;
        $film->genre_id = $request->genre_id;
        $film->director = $request->director;
        $film->synopsis = $request->synopsis;
        $film->duration = $request->duration;

        // Simpan perubahan
        $film->save();

        return redirect()->route('admin.home')->with('success', 'Film updated successfully.');
    }

    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        return redirect()->route('admin.home')->with('success', 'Film deleted successfully.');
    }
}
