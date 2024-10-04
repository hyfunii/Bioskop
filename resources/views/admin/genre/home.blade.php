@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-center text-3xl font-bold">Genre List</h1>
            <a href="{{ route('admin.genre.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Add
                Genre</a>
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
                        <th class="border border-gray-200 p-2">Name</th>
                        <th class="border border-gray-200 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td class="border border-gray-200 p-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-200 p-2">{{ $genre->name }}</td>
                            <td class="border border-gray-200 p-2 flex space-x-2">
                                <a href="{{ route('admin.genre.edit', $genre->genre_id) }}"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Edit</a>
                                <form action="{{ route('admin.genre.destroy', $genre->genre_id) }}" method="POST"
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
