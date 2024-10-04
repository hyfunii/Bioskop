@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-center text-3xl font-bold">Film List</h1>
            <a href="{{ route('admin.films.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Add Film</a>
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
                        <th class="border border-gray-200 p-2">No.</th>
                        <th class="border border-gray-200 p-2">Film Name</th>
                        <th class="border border-gray-200 p-2">Genre</th>
                        <th class="border border-gray-200 p-2">Director</th>
                        <th class="border border-gray-200 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($films as $index => $film)
                        <tr>
                            <td class="border border-gray-200 p-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-200 p-2">{{ $film->name }}</td>
                            <td class="border border-gray-200 p-2">{{ $film->genre->name }}</td>
                            <td class="border border-gray-200 p-2">{{ $film->director }}</td>
                            <td class="border border-gray-200 p-2 flex space-x-2">
                                <!-- Detail Button -->
                                <a href="{{ route('admin.films.show', $film->film_id) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg">Details</a>

                                <!-- Edit Button -->
                                <a href="{{ route('admin.films.edit', $film->film_id) }}"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Edit</a>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.films.destroy', $film->film_id) }}" method="POST"
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
