@extends('layout.app')

@section('content')
    <h1 class="text-center text-3xl font-bold">Add New Film</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data"
        class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf
        <div class="mb-4">
            <label class="block">Film Name</label>
            <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block">Genre</label>
            <select name="genre_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
                <option value="">Select Genre</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->genre_id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block">Director</label>
            <input type="text" name="director" class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block">Synopsis</label>
            <textarea name="synopsis" class="w-full p-2 border border-gray-300 rounded-lg" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block">Duration (in minutes)</label>
            <input type="number" min="1" name="duration" class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block">Film Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="w-full p-2 border border-gray-300 rounded-lg"
                required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Add Film</button>
    </form>

@endsection
