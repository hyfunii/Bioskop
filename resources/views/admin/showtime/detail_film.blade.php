@extends('layout.app')

@section('content')
<h1 class="text-center text-3xl font-bold">{{ $showtime->film->name }} - Showtime Details</h1>

<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg mt-4">
    <div class="mb-4">
        <strong>Film Image:</strong><br>
        @if ($showtime->film->image)
            <img src="{{ asset('images/' . $showtime->film->image) }}" alt="{{ $showtime->name }}" class="w-full h-auto">
        @else
            <span>No image available.</span>
        @endif
    </div>
    <div class="mb-4">
        <strong>Film Name:</strong> <span>{{ $showtime->film->name }}</span>
    </div>
    <div class="mb-4">
        <strong>Genre:</strong> <span>{{ $showtime->film->genre->name }}</span>
    </div>
    <div class="mb-4">
        <strong>Director:</strong> <span>{{ $showtime->film->director }}</span>
    </div>
    <div class="mb-4">
        <strong>Showtime:</strong> <span>{{ \Carbon\Carbon::parse($showtime->showtime)->format('d M Y H:i') }}</span>
    </div>
    <div class="mb-4">
        <strong>Room:</strong> <span>{{ $showtime->room->name }}</span> <!-- Display room name -->
    </div>

    <div class="mb-4">
        <strong>Booked Seats:</strong>
        @if (count($bookedSeats) > 0)
            <ul class="list-disc list-inside">
                @foreach ($bookedSeats as $seat)
                    <li>{{ $seat }}</li>
                @endforeach
            </ul>
        @else
            <span>No seats booked for this showtime.</span>
        @endif
    </div>

    <a href="{{ route('admin.showtime.home') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Back to List</a>
</div>
@endsection
