@extends('layout.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Manajemen Tiket Anda</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @php
            $bookings = Auth::user()->bookings()->with('showtime.film', 'room')->get();
        @endphp

        @if($bookings->isEmpty())
            <p class="text-gray-600">Anda belum memesan tiket.</p>
        @else
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Film</th>
                        <th class="border px-4 py-2">Ruang</th>
                        <th class="border px-4 py-2">Kursi</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="border px-4 py-2">{{ $booking->showtime->film->name }}</td>
                            <td class="border px-4 py-2">{{ $booking->room->name }}</td>
                            <td class="border px-4 py-2">{{ $booking->booked }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('booking.cancel', $booking->booking_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan tiket ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Batalkan</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
