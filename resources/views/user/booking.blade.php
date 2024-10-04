@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="border border-gray-300 rounded-lg shadow-lg flex">
            <div class="w-1/3 p-4">
                @if ($showtime->film->image)
                    <img src="{{ asset('images/' . $showtime->film->image) }}" alt="{{ $showtime->film->name }}" class="w-full h-auto">
                @else
                    <span>No image available.</span>
                @endif
            </div>
            <div class="w-2/3 p-4">
                <h2 class="text-2xl font-bold">{{ $showtime->film->name }}</h2>
                <p class="text-sm text-gray-600">Genre: {{ $showtime->film->genre->name }}</p>
                <p class="text-sm text-gray-600">Sutradara: {{ $showtime->film->director }}</p>
                <p class="text-sm text-gray-600">Jadwal Tayang: {{ \Carbon\Carbon::parse($showtime->showtime)->format('d M Y H:i') }}</p>

                <form action="{{ route('booking.confirm') }}" method="POST">
                    @csrf
                    <div class="mt-4">
                        <label for="seats" class="block font-semibold">Pilih Kursi:</label>
                        <select name="seats[]" id="seats" class="border border-gray-300 p-2 rounded-lg w-full" multiple>
                            @foreach ($availableSeats as $seat)
                                <option value="{{ $seat }}">{{ $seat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="showtime_id" value="{{ $showtime->showtime_id }}">
                    <input type="hidden" name="room_id" value="{{ $showtime->room->room_id }}">

                    <button type="submit" class="inline-block mt-4 bg-blue-500 text-white p-2 rounded-lg">Konfirmasi Pilihan</button>
                </form>
            </div>
        </div>

        {{-- Tampilkan kursi yang sudah dipesan --}}
        <div class="mt-8">
            <h4 class="font-semibold">Kursi yang Sudah Dipesan:</h4>
            <ul>
                @forelse ($bookedSeats as $bookedSeat)
                    <li class="text-red-600">Kursi {{ $bookedSeat }}</li>
                @empty
                    <li class="text-green-600">Belum ada kursi yang dipesan.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
