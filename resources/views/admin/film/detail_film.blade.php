@extends('layout.app')

@section('content')
    <h1 class="text-center text-3xl font-bold">{{ $film->name }} - Details</h1>

    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg mt-4">
        <div class="mb-4">
            <strong>Film Image:</strong><br>
            @if ($film->image)
                <img src="{{ asset('images/' . $film->image) }}" alt="{{ $film->name }}" class="w-full h-auto">
            @else
                <span>No image available.</span>
            @endif
        </div>

        <div class="mb-4">
            <strong>Film Name:</strong> <span>{{ $film->name }}</span>
        </div>
        <div class="mb-4">
            <strong>Genre:</strong> <span>{{ $film->genre->name }}</span>
        </div>
        <div class="mb-4">
            <strong>Director:</strong> <span>{{ $film->director }}</span>
        </div>
        <div class="mb-4">
            <strong>Synopsis:</strong>
            <p>{{ $film->synopsis }}</p>
        </div>
        <div class="mb-4">
            <strong>Duration:</strong> <span>{{ $film->duration }} minutes</span>
        </div>
        <a href="{{ route('admin.home') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Back to List</a>
    </div>
@endsection
