<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Showtime;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    // Store the rating and comment
    public function show($film_id)
    {
        $film = Film::with('genre', 'ratings.user')->findOrFail($film_id); // Include related user data for ratings
        $showtimes = Showtime::where('film_id', $film_id)->get();
        $userRating = null;

        if (Auth::check()) {
            // Check if the logged-in user has already rated this film
            $userRating = Rating::where('film_id', $film_id)
                ->where('user_id', Auth::id())
                ->first();
        }

        return view('admin.rating.details', compact('film', 'showtimes', 'userRating'));
    }

    // Store Rating (new rating submission logic)
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Create or update the rating
        Rating::updateOrCreate(
            ['user_id' => Auth::id(), 'film_id' => $request->film_id],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        return back()->with('success', 'Rating berhasil disimpan.');
    }

    // Update Rating (existing rating edit)
    public function update(Request $request, $rating_id)
    {
        $rating = Rating::findOrFail($rating_id);
        $this->authorize('update', $rating);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $rating->update($request->only('rating', 'comment'));

        return back()->with('success', 'Rating berhasil diperbarui.');
    }

    public function destroy($rating_id)
    {
        $rating = Rating::findOrFail($rating_id);
        $this->authorize('delete', $rating);
        $rating->delete();

        return back()->with('success', 'Rating berhasil dihapus.');
    }

    public function booking($showtime_id)
    {
        $showtime = Showtime::with('film')->findOrFail($showtime_id);
        return view('user.booking', compact('showtime'));
    }


}
