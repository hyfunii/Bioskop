<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Film;
use App\Models\Rating;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Showtime;
use Auth;
use Request;

class UserFilmController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::with('film')->get();

        return view('user.home', compact('showtimes'));
    }

    public function show($id)
    {
        // Ambil data showtime beserta relasi film dan rating
        $showtime = Showtime::with('film.genre', 'film.ratings.user')->findOrFail($id);

        // Cek rating pengguna jika login
        $userRating = null;
        if (Auth::check()) {
            $userRating = Rating::where('film_id', $showtime->film->film_id)
                ->where('user_id', Auth::id())
                ->first();
        }

        return view('user.detail_film', compact('showtime', 'userRating'));
    }

    // Menampilkan halaman booking
    public function booking($showtime_id)
    {
        $showtime = Showtime::with(['film', 'room'])->findOrFail($showtime_id);

        // Ambil kursi yang sudah dipesan untuk room ini
        $bookedSeats = Booking::where('showtime_id', $showtime_id)->pluck('seats')->flatten()->toArray();
        return view('user.booking', compact('showtime', 'bookedSeats'));
    }

    // Mengkonfirmasi booking
    public function confirmBooking(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'room_id' => 'required|exists:rooms,id', // Validasi room_id
            'seats' => 'required|json',
        ]);

        $seats = json_decode($request->seats);

        // Simpan informasi booking di database
        Booking::create([
            'showtime_id' => $request->showtime_id,
            'room_id' => $request->room_id, // Simpan room_id
            'seats' => json_encode($seats), // Menyimpan kursi sebagai JSON
            'user_id' => Auth::id(), // Menyimpan ID user yang memesan
        ]);

        return response()->json(['success' => true]);
    }

    // Menampilkan daftar booking untuk pengguna (opsional)
    public function myBookings()
    {
        $bookings = Booking::with('showtime.film', 'room')->where('user_id', Auth::id())->get();
        return view('user.my_bookings', compact('bookings'));
    }
}

// public function show($id)
// {
//     $film = Film::with('genre')->findOrFail($id);
//     $showtimes = Showtime::where('film_id', $id)->get();

//     return view('user.detail_film', compact('film', 'showtimes'));
// }