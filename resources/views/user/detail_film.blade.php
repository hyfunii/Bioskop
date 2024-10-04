@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="border border-gray-300 rounded-lg shadow-lg flex">
            <div class="w-1/3 p-4">
                @if ($showtime->film->image)
                    <img src="{{ asset('images/' . $showtime->film->image) }}" alt="{{ $showtime->film->name }}"
                        class="w-full h-auto">
                @else
                    <span>No image available.</span>
                @endif
            </div>
            <div class="w-2/3 p-4">
                <h2 class="text-2xl font-bold">{{ $showtime->film->name }}</h2>
                <p class="text-sm text-gray-600">Genre: {{ $showtime->film->genre->name }}</p>
                <p class="text-sm text-gray-600">Producer: {{ $showtime->film->director }}</p>
                <p class="text-sm text-gray-600">Showtime:</p>
                <ul class="list-disc list-inside">
                    <li>{{ \Carbon\Carbon::parse($showtime->showtime)->format('d M Y H:i') }}</li>
                </ul>
                <a href="{{ route('booking.show', $showtime->showtime_id) }}" class="inline-block mt-4 bg-blue-500 text-white p-2 rounded-lg">Booking Tiket</a>
            </div>
        </div>

        <div class="mt-4 p-4 border border-gray-300 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Sinopsis</h3>
            <p class="mt-2 text-gray-700">{{ $showtime->film->synopsis }}</p>
        </div>

        {{-- Rating and Comments Section --}}
        <div class="mt-6 p-4 border border-gray-300 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Comment & Rating</h3>

            @if (session('success'))
                <div class="mt-4 p-4 bg-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mt-4 p-4 bg-red-200 text-red-800 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Auth::check() && !$userRating)
                <form action="{{ route('ratings.store') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5):</label>
                        <input type="number" name="rating" id="rating"
                            class="mt-1 p-2 block w-full border-gray-300 rounded-md" min="1" max="5" required>
                    </div>

                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700">Komentar:</label>
                        <textarea name="comment" id="comment" rows="3" class="mt-1 p-2 block w-full border-gray-300 rounded-md"
                            required></textarea>
                    </div>

                    <input type="hidden" name="film_id" value="{{ $showtime->film->film_id }}">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Submit</button>
                </form>
            @elseif (Auth::check() && $userRating)
                <div class="mt-4 p-4 bg-gray-100 border rounded-lg">
                    <p class="text-sm text-gray-600">Anda sudah memberi rating:</p>
                    <p class="text-lg">Rating: {{ $userRating->rating }}</p>
                    <p class="text-md">Comment: {{ $userRating->comment }}</p>

                    <form action="{{ route('user.ratings.update', $userRating->rating_id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700">Ubah Rating (1-5):</label>
                            <input type="number" name="rating" id="rating"
                                class="mt-1 p-2 block w-full border-gray-300 rounded-md" min="1" max="5"
                                value="{{ $userRating->rating }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700">Change Comment:</label>
                            <textarea name="comment" id="comment" rows="3" class="mt-1 p-2 block w-full border-gray-300 rounded-md"
                                required>{{ $userRating->comment }}</textarea>
                        </div>

                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-md">Update</button>
                    </form>

                    <form action="{{ route('user.ratings.destroy', $userRating->rating_id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md">Delete</button>
                    </form>
                </div>
            @else
                <p class="text-sm text-gray-600">Silakan <a href="{{ route('login') }}" class="text-blue-600">login</a>
                    untuk memberikan rating dan komentar.</p>
            @endif

            {{-- Display all ratings for the film --}}
            <div class="mt-6">
                <h4 class="text-lg font-semibold">All Ratings</h4>
                @foreach ($showtime->film->ratings as $rating)
                    <div class="mt-4 p-4 bg-gray-50 border rounded-lg">
                        <p class="text-sm text-gray-600">{{ $rating->user->name }} memberi rating:</p>
                        <p class="text-lg">Rating: {{ $rating->rating }}</p>
                        <p class="text-md">Komentar: {{ $rating->comment }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
