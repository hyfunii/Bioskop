@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <h2 class="text-center text-3xl font-bold">Create Room</h2>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rooms.store') }}" method="POST"
            class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg mt-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Room Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('name') }}" required>
            </div>

            <div class="flex">
                <button type="submit" class="w-1/4 mr-2 text-center bg-blue-500 text-white p-2 rounded-lg">Save</button>
                <a href="{{ route('admin.rooms.home') }}" class="w-1/4 mr-2 text-center bg-gray-500 text-white p-2 rounded-lg">Cancel</a>
            </div>
        </form>
    </div>
@endsection
