<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Film;
use App\Models\Room;
use App\Models\Showtime;
use DB;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::with('film', 'room')
            ->withCount([
                'bookings as unique_bookings_count' => function ($query) {
                    // Count distinct booking_ids for the specified criteria
                    $query->select(DB::raw("COUNT(DISTINCT booking_id)"))
                        ->where('room_id', '<>', ''); // Adjust as needed
                }
            ])
            ->get();
        return view('admin.showtime.home', compact('showtimes'));
    }

    // public function show($id)
    // {
    //     $showtime = Showtime::where('showtime_id', $id)->first();
    //     return view('admin.showtime.detail_film', compact('showtime'));
    // }

    public function show($id)
    {
        $showtime = Showtime::with(['film', 'room'])->where('showtime_id', $id)->firstOrFail();

        $bookedSeats = Booking::where('showtime_id', $showtime->showtime_id)
            ->where('room_id', $showtime->room->room_id)
            ->pluck('booked')
            ->toArray();
        return view('admin.showtime.detail_film', compact('showtime', 'bookedSeats'));
    }


    public function create()
    {
        $films = Film::all();
        $rooms = Room::all();
        return view('admin.showtime.create', compact('films', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,film_id',
            'room_id' => 'required|exists:rooms,room_id',
            'showtime' => 'required|date'
        ]);

        $existingShowtime = Showtime::where('film_id', $request->film_id)
            ->where('showtime', $request->showtime)
            ->first();

        if ($existingShowtime) {
            return redirect()->back()->withErrors(['showtime' => 'This showtime for the film already exists.']);
        }

        Showtime::create([
            'film_id' => $request->film_id,
            'room_id' => $request->room_id,
            'showtime' => $request->showtime,
        ]);

        return redirect()->route('admin.showtime.home')->with('success', 'Showtime created successfully.');
    }


    public function edit($id)
    {
        $showtime = Showtime::where('showtime_id', $id)->first();
        $rooms = Room::all();
        return view('admin.showtime.edit', compact('showtime', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'room_id' => 'required|exists:rooms,room_id',
            'showtime' => 'required|date'
        ]);

        // Find the showtime by ID
        $showtime = Showtime::findOrFail($id);

        // Update the showtime details
        $showtime->room_id = $request->input('room_id');
        $showtime->showtime = $request->input('showtime');

        // Save the changes
        $showtime->save();

        // Redirect back with a success message
        return redirect()->route('admin.showtime.home')->with('success', 'Showtime updated successfully!');
    }

    public function destroy($id)
    {
        $showtime = Showtime::findOrFail($id);
        $showtime->delete();

        return redirect()->route('admin.showtime.home')->with('success', 'Showtime deleted successfully.');
    }
}

