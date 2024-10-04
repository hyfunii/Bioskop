@extends('layout.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-center text-2xl font-bold mb-6">Register</h2>

    {{-- Menampilkan error jika ada --}}
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/register') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block">Name</label>
            <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block">Password</label>
            <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Register</button>
    </form>
</div>
@endsection
