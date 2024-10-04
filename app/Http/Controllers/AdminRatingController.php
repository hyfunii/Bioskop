<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Film;

class AdminRatingController extends Controller
{
    // Show all films that have ratings
    public function index()
    {
        // Get all films with ratings
        $films = Film::with('ratings')->get();
        
        return view('admin.rating.home', compact('films'));
    }

    public function show($film_id)
    {
        // Get film details and ratings for the specified film_id
        $film = Film::with('ratings')->findOrFail($film_id);
        $averageRating = $film->ratings->avg('rating');

        return view('admin.rating.details', compact('film', 'averageRating'));
    }

    // Delete a rating
    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return redirect()->back()->with('success', 'Rating has been deleted successfully.');
    }
}
