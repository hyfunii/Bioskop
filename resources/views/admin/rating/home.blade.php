<!-- resources/views/admin/rating/home.blade.php -->

@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-center text-3xl font-bold">Film Ratings</h1>
        </div>
        <div class="mt-4">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-200 p-2">No</th>
                        <th class="border border-gray-200 p-2">Nama Film</th>
                        <th class="border border-gray-200 p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($films as $index => $film)
                        <tr>
                            <td class="border border-gray-200 p-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-200 p-2">{{ $film->name }}</td>
                            <td class="border border-gray-200 p-2 flex space-x-2">
                                <a href="{{ route('admin.ratings.details', $film->film_id) }}"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
