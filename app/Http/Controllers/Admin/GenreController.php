<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.home', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (Genre::where('name', $request->name)->exists()) {
            return redirect()->back()->withErrors(['name' => 'This genre already exists.'])->withInput();
        }

        Genre::create(['name' => $request->name]);

        return redirect()->route('admin.genre.home')->with('success', 'Genre created successfully.');
    }


    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $id . ',genre_id',
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update(['name' => $request->name]);

        return redirect()->route('admin.genre.home')->with('success', 'Genre updated successfully.');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('admin.genre.home')->with('success', 'Genre deleted successfully.');
    }
}
