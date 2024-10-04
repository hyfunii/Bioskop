@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-center text-3xl font-bold">Showtime List</h1>
            <a href="{{ route('admin.showtime.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Add
                Showtime</a>
        </div>

        {{-- @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif --}}
        <div class="mt-4">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-200 p-2">No</th>
                        <th class="border border-gray-200 p-2">Film Name</th>
                        <th class="border border-gray-200 p-2">Genre</th>
                        <th class="border border-gray-200 p-2">Director</th>
                        <th class="border border-gray-200 p-2">Showtime</th>
                        <th class="border border-gray-200 p-2">Room</th>
                        <th class="border border-gray-200 p-2">Booked Seats</th>
                        <th class="border border-gray-200 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($showtimes as $index => $showtime)
                        <tr>
                            <td class="border border-gray-200 p-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-200 p-2">{{ $showtime->film->name }}</td>
                            <td class="border border-gray-200 p-2">{{ $showtime->film->genre->name }}</td>
                            <td class="border border-gray-200 p-2">{{ $showtime->film->director }}</td>
                            <td class="border border-gray-200 p-2">{{ $showtime->showtime }}</td>
                            <td class="border border-gray-200 p-2">{{ $showtime->room->name }}</td>
                            <td class="border border-gray-200 p-2">{{ $showtime->unique_bookings_count ?? 0 }}</td>
                            <td class="border border-gray-200 p-2 flex space-x-2">
                                <a href="{{ route('admin.showtime.show', $showtime->showtime_id) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg">Details</a>

                                <a href="{{ route('admin.showtime.edit', $showtime->showtime_id) }}"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Edit</a>

                                <form action="{{ route('admin.showtime.destroy', $showtime->showtime_id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
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
