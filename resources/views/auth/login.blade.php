@extends('layout.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-center text-2xl font-bold mb-6">Login</h2>
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block">Password</label>
            <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Login</button>
    </form>
</div>
@endsection
