<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::all();
        return view('admin.room.home', compact('rooms'));
    }

    public function create()
    {
        return view('admin.room.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if (Room::where('name', $request->name)->exists()) {
            return redirect()->back()->withErrors(['name' => 'This room already exists.'])->withInput();
        }

        Room::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.rooms.home')->with('success', 'Room created successfully.');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.room.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $room = Room::findOrFail($id);
        if (Room::where('name', $request->name)->where('room_id', '!=', $id)->exists()) {
            return redirect()->back()->withErrors(['name' => 'This room already exists.']);
        }
        $room->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.rooms.home')->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.rooms.home')->with('success', 'Room deleted successfully.');
    }
}
