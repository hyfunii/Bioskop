<!-- resources/views/admin/rating/details.blade.php -->

@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="border border-gray-300 rounded-lg shadow-lg flex">
            <div class="w-1/3 p-4">
                @if ($film->image)
                    <img src="{{ asset('images/' . $film->image) }}" alt="{{ $film->name }}" class="w-full h-auto">
                @else
                    <span>No image available.</span>
                @endif
            </div>
            <div class="w-2/3 p-4">
                <h1 class="text-2xl font-bold">{{ $film->name }}</h1>
                <p class="text-sm text-gray-600">Avereage: {{ number_format($averageRating, 1) }}</p>
                <p class="text-sm text-gray-600">Producer: {{ $film->director }}</p>
                <p class="text-sm text-gray-600">Genre: {{ $film->genre->name }}</p>
            </div>
        </div>

        <div class="mt-4 p-4 border border-gray-300 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">Sinopsis</h2>
            <p class="mt-2 text-gray-700">{{ $film->synopsis }}</p>
        </div>

        <div class="mt-6 p-4 border border-gray-300 rounded-lg shadow-md">
            <div class="mt-6">
                <h4 class="text-lg font-semibold">All Ratings</h4>
                @foreach ($film->ratings as $rating)
                    <div class="mt-4 p-4 bg-gray-50 border rounded-lg">
                        <p class="text-sm text-gray-600">{{ $rating->user->name }} memberi rating:</p>
                        <p class="text-lg">Rating: {{ $rating->rating }}</p>
                        <p class="text-md">Komentar: {{ $rating->comment }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- <div class="mt-4 p-4 border border-gray-300 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold">Semua Rating Pengguna</h2>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nama</th>
                        <th class="py-2 px-4 border-b">Rating</th>
                        <th class="py-2 px-4 border-b">Komentar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($film->ratings as $rating)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $rating->user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $rating->rating }}</td>
                            <td class="py-2 px-4 border-b">{{ $rating->comment }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    </div>
@endsection
