@extends('layout.app')

@section('content')
    <h1 class="text-center text-3xl font-bold">Edit Film</h1>
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg mt-4">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-4">
            <strong>Film Image:</strong><br>
            @if ($film->image)
                <img src="{{ asset('images/' . $film->image) }}" alt="{{ $film->name }}" class="w-full h-auto">
            @else
                <span>No image available.</span>
            @endif
        </div>
        <form action="{{ route('admin.films.update', $film->film_id) }}" method="POST" enctype="multipart/form-data"
            class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block">Film Name</label>
                <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ $film->name }}" required>
            </div>
            <div class="mb-4">
                <label class="block">Genre</label>
                <select name="genre_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="">Select Genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->genre_id }}" {{ $film->genre_id == $genre->genre_id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block">Director</label>
                <input type="text" name="director" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ $film->director }}" required>
            </div>
            <div class="mb-4">
                <label class="block">Synopsis</label>
                <textarea name="synopsis" class="w-full p-2 border border-gray-300 rounded-lg" required>{{ $film->synopsis }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block">Duration (in minutes)</label>
                <input type="number" min="1" name="duration" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ $film->duration }}" required>
            </div>
            <div class="mb-4">
                <label class="block">Film Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Update Film</button>
        </form>
    </div>
    @endsection
