@extends('layout.app')

@section('content')
    <h1 class="text-center text-3xl font-bold mb-6">Upcoming Films</h1>

    <div class="grid grid-cols-4 sm:grid-cols-2 md:grid-cols-6 gap-2">
        @foreach ($showtimes as $showtime)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                <img src="{{ asset('images/' . $showtime->film->image) }}" alt="{{ $showtime->name }}"
                    class="w-full h-64 object-cover">
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="font-bold text-xl">{{ $showtime->film->name }}</h2>
                        <p class="text-gray-700">{{ $showtime->film->director }}</p>
                        <p class="text-gray-700">{{ $showtime->film->genre->name }}</p>
                        <p class="text-gray-500">{{ date('d M Y, H:i', strtotime($showtime->showtime)) }}</p>
                    </div>
                    <a href="{{ route('user.film.show', $showtime->showtime_id) }}"
                        class="mt-4 bg-blue-500 text-white p-2 rounded-lg text-center">Film Detail</a>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection
