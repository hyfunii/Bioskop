@extends('layout.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold">Edit Room</h2>

    <form action="{{ route('admin.rooms.update', $room->room_id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Room Name</label>
            <input type="text" name="name" id="name" class="mt-1 p-2 block w-full border-gray-300 rounded-md" value="{{ $room->name }}" required>
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update</button>
        <a href="{{ route('admin.rooms.home') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md">Cancel</a>
    </form>
</div>
@endsection
