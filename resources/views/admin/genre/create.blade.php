@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-center text-3xl font-bold">Add New Genre</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.genre.store') }}" method="POST"
            class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg mt-4">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Genre Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Add Genre</button>
        </form>
    </div>
@endsection
