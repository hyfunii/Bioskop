<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function show($id)
    {
        $showtime = Showtime::with('film', 'room')->find($id);

        // Jika showtime tidak ditemukan
        if (!$showtime) {
            return redirect()->back()->withErrors('Showtime tidak ditemukan.');
        }

        // Ambil kursi yang sudah dipesan
        $bookedSeats = Booking::where('showtime_id', $showtime->showtime_id)
            ->where('room_id', $showtime->room->room_id)
            ->pluck('booked')
            ->toArray();

        // Array dari semua kursi yang tersedia (1 sampai 50)
        $allSeats = range(1, 50);

        // Filter kursi yang belum dipesan
        $availableSeats = array_diff($allSeats, $bookedSeats);

        // Kirim data ke view
        return view('user.booking', compact('showtime', 'availableSeats', 'bookedSeats'));
    }

    public function confirm(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'showtime_id' => 'required|exists:showtimes,showtime_id',
            'room_id' => 'required|exists:rooms,room_id',
            'seats' => 'required|array|min:1', // Minimal 1 kursi harus dipilih
            'seats.*' => 'integer'
        ]);

        // Simpan kursi yang dipilih ke dalam tabel booking
        foreach ($validated['seats'] as $seat) {
            Booking::create([
                'showtime_id' => $validated['showtime_id'],
                'room_id' => $validated['room_id'],
                'booked' => $seat,
                'user_id' => auth()->id(), // Simpan user_id dari pengguna yang terautentikasi
            ]);
        }

        // Redirect ke halaman film dengan notifikasi
        return redirect()->route('user.film.show', $validated['showtime_id'])
            ->with('success', 'Tiket berhasil dipesan.');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        // Pastikan pengguna hanya dapat membatalkan tiket miliknya
        if ($booking->user_id !== auth()->id()) {
            return redirect()->back()->withErrors('Anda tidak memiliki akses untuk membatalkan tiket ini.');
        }

        $booking->delete();

        return redirect()->back()->with('success', 'Tiket berhasil dibatalkan.');
    }

}
