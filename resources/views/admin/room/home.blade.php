@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center">
            <h2 class="text-center text-3xl font-bold">Rooms</h2>
            <a href="{{ route('admin.rooms.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Create Room</a>
        </div>

        {{-- @if (session('success'))
            <div class="mt-4 p-4 bg-green-200 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif --}}

        <div class="mt-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2">No</th>
                        <th class="border border-gray-300 p-2">Name</th>
                        <th class="border border-gray-300 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td class="border border-gray-200 p-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-200 p-2">{{ $room->name }}</td>
                            <td class="border border-gray-200 p-2 flex space-x-2">
                                <a href="{{ route('admin.rooms.edit', $room->room_id) }}"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Edit</a>
                                <form action="{{ route('admin.rooms.destroy', $room->room_id) }}" method="POST"
                                    class="inline-block"onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
