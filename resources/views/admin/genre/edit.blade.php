@extends('layout.app')

@section('content')
<h1 class="text-center text-3xl font-bold">Edit Genre</h1>

@if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.genre.update', $genre->genre_id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block">Genre Name</label>
        <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ $genre->name }}" required>
    </div>
    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Update Genre</button>
</form>
@endsection
