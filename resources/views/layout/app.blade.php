<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        #notification {
            opacity: 0;
            /* Start as invisible */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <!-- Logo -->
                    <div>
                        <a href="/" class="flex items-center py-5 px-2 text-gray-700 hover:text-gray-900">
                            <span class="font-bold text-xl">Cinnemax</span>
                        </a>
                    </div>

                    <!-- Primary Navbar items -->
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <div class="hidden md:flex items-center space-x-1">
                                <a href="{{ route('admin.showtime.home') }}"
                                    class="py-5 px-3 text-gray-700 hover:text-gray-900">Showtime</a>
                            </div>
                            <div class="hidden md:flex items-center space-x-1">
                                <a href="{{ route('admin.genre.home') }}"
                                    class="py-5 px-3 text-gray-700 hover:text-gray-900">Genre</a>
                            </div>
                            <div class="hidden md:flex items-center space-x-1">
                                <a href="{{ route('admin.home') }}" class="py-5 px-3 text-gray-700 hover:text-gray-900">Film
                                    List</a>
                            </div>
                            <div class="hidden md:flex items-center space-x-1">
                                <a href="{{ route('admin.ratings.home') }}"
                                    class="py-5 px-3 text-gray-700 hover:text-gray-900">Rating Film</a>
                            </div>
                            <div class="hidden md:flex items-center space-x-1">
                                <a href="{{ route('admin.rooms.home') }}"
                                    class="py-5 px-3 text-gray-700 hover:text-gray-900">Room Management</a>
                            </div>
                        @endif
                    @endauth
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Authentication Links -->
                    <div class="relative">
                        @auth
                            <button
                                class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none focus:text-gray-900"
                                id="userMenuButton">
                                <span>{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-48 bg-white shadow-md rounded-lg py-2 hidden"
                                id="userDropdown">
                                <a href="{{ route('user.profile') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a>
                                <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left text-gray-700 hover:bg-gray-200">Logout</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="py-5 px-3">Login</a>
                            <a href="{{ route('register') }}"
                                class="py-2 px-3 bg-blue-500 text-white rounded hover:bg-blue-700">Sign Up</a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button class="mobile-menu-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu hidden md:hidden">
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.showtime.home') }}"
                        class="block py-2 px-4 text-sm hover:bg-gray-200">Showtime</a>
                    <a href="{{ route('admin.genre.home') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Genre</a>
                    <a href="{{ route('admin.home') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Film List</a>
                    <a href="{{ route('admin.ratings.home') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Rating
                        Film</a>
                    <a href="{{ route('admin.rooms.home') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Room
                        Management</a>
                @endif
                <a href="{{ route('admin.home') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Profile</a>
                <form action="{{ route('logout') }}" method="POST" class="block py-2 px-4">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm hover:bg-gray-200">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 px-4 text-sm hover:bg-gray-200">Login</a>
                <a href="{{ route('register') }}"
                    class="block py-2 px-4 text-sm bg-blue-500 text-white hover:bg-blue-700">Sign Up</a>
            @endauth
        </div>
    </nav>

    {{-- <div class="container mx-auto mt-6">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="container mx-auto p-4 mt-16 bg-white">
            @yield('content')
        </div>
    </div> --}}

    <div class="container mx-auto mt-6">
        <div class="container mx-auto p-4 mt-16 bg-white">
            @yield('content')
        </div>
    </div>

    <div id="notification"
        class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg hidden transition-opacity duration-300">
        <span id="notification-message"></span>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');

        userMenuButton.addEventListener('click', () => {
            userDropdown.classList.toggle('hidden');
        });

        // Menutup dropdown jika klik di luar
        window.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });

        // Function to show notification
        function showNotification(message) {
            const notification = document.getElementById('notification');
            const messageSpan = document.getElementById('notification-message');

            messageSpan.textContent = message;
            notification.classList.remove('hidden');
            notification.style.opacity = 1; // Set opacity to 1 to show

            // Automatically hide the notification after 3 seconds
            setTimeout(() => {
                notification.style.opacity = 0; // Fade out
                setTimeout(() => {
                    notification.classList.add('hidden'); // Hide completely
                }, 300); // Match the duration of the CSS transition
            }, 3000); // Show for 3 seconds
        }

        // Show notification if session messages exist
        window.onload = function() {
            @if (session('success'))
                showNotification("{{ session('success') }}");
            @endif
            @if (session('error'))
                showNotification("{{ session('error') }}");
            @endif
        };
    </script>
</body>

</html>
