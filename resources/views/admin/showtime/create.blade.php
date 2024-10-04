@extends('layout.app')

@section('content')
    <h1 class="text-center text-3xl font-bold">Add New Showtime</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.showtime.store') }}" method="POST"
        class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf
        <div class="mb-4">
            <label class="block">Film</label>
            <select name="film_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
                <option value="">Select Film</option>
                @foreach ($films as $film)
                    <option value="{{ $film->film_id }}">{{ $film->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Room</label>
            <select name="room_id" class="w-full p-2 border border-gray-300 rounded-lg" required>
                <option value="">Select Room</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->room_id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Showtime</label>
            <input type="datetime-local" name="showtime" class="w-full p-2 border border-gray-300 rounded-lg" required
                id="showtime-input">
            <span id="showtime-warning" style="display: none; color: red;">Please enter a showtime that is at least 3 days
                ahead of the current time.</span>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg" id="add-button">Add Showtime</button>

    </form>

    <script>
        const showtimeInput = document.getElementById('showtime-input');
        const showtimeWarning = document.getElementById('showtime-warning');
        const addButton = document.getElementById('add-button');

        showtimeInput.addEventListener('input', () => {
            const showtimeValue = showtimeInput.value;
            const currentTime = new Date();
            const minAllowedDate = new Date(currentTime.getTime() + 3 * 24 * 60 * 60 * 1000); // 3 days ahead
            const showtimeDate = new Date(showtimeValue);

            if (showtimeDate < minAllowedDate) {
                showtimeWarning.style.display = 'block';
                addButton.disabled = true;
            } else {
                showtimeWarning.style.display = 'none';
                addButton.disabled = false;
            }
        });
    </script>
@endsection
