{{-- @extends('layout.app')

@section('content')
<h1 class="text-center text-3xl font-bold">Edit Showtime</h1>

@if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.showtime.update', $showtime->showtime_id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block">Showtime</label>
        <input type="datetime-local" name="showtime" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $showtime->showtime }}" required>
    </div>
    <button type="submit" class="bg-yellow-500 text-white p-2 rounded-lg">Update Showtime</button>
</form>
@endsection --}}

@extends('layout.app')

@section('content')
<h1 class="text-center text-3xl font-bold">Edit Showtime</h1>

@if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.showtime.update', $showtime->showtime_id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block">Film</label>
        <input type="text" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $showtime->film->name }}" readonly>
    </div>

    <div class="mb-4">
        <label class="block">Room</label>
        <select name="room_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
            <option value="">Select Room</option>
            @foreach ($rooms as $room)
                <option value="{{ $room->room_id }}" {{ $room->room_id == $showtime->room_id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-4">
        <label class="block">Showtime</label>
        <input type="datetime-local" name="showtime" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $showtime->showtime }}" required>
    </div>

    <button type="submit" class="bg-yellow-500 text-white p-2 rounded-lg">Update Showtime</button>
</form>
@endsection
