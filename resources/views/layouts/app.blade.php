<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Portal Informasi Karawang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
</head>
<body class="bg-white text-green-900 min-h-screen font-poppins m-0">
    <header class="bg-white bg-opacity-80 backdrop-saturate-180 backdrop-blur-md shadow-md border-b border-green-300 p-4 sm:p-6 sticky top-0 z-50 flex flex-row justify-between items-center">
        <div class="flex items-center space-x-2 sm:space-x-4 w-auto justify-start">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ url('/') }}" class="logo text-base font-semibold flex items-center space-x-2 text-green-800 hover:text-green-900 tracking-tight">
                        <img src="{{ asset('storage/logo sidebar/logokrw.png') }}" alt="Logo" class="h-10 sm:h-12 w-auto" />
                        <span class="text-xs sm:text-sm">Dashboard Admin Web Portal Karawang</span>
                    </a>
                @else
                    <a href="{{ url('/') }}" class="logo flex items-center space-x-2 sm:space-x-4 text-green-800 hover:text-green-900 tracking-tight font-semibold text-base min-w-[200px] max-w-none overflow-visible justify-center sm:justify-start">
                        <img src="{{ asset('storage/logo sidebar/logokrw.png') }}" alt="Logo" class="h-24 sm:h-48 md:h-64 lg:h-72 xl:h-80 w-auto max-w-full" style="min-width: 150px !important; height: auto !important; max-width: none !important;" />
                        <span class="text-base sm:text-lg md:text-xl lg:text-2xl xl:text-3xl font-semibold">Portal Informasi Karawang</span>
                    </a>
                @endif
            @else
                <a href="{{ url('/') }}" class="logo flex items-center space-x-2 text-green-800 hover:text-green-900 tracking-tight font-semibold text-base justify-center sm:justify-start w-full sm:w-auto">
                    <img src="{{ asset('storage/logo sidebar/logokrw.png') }}" alt="Logo" class="h-10 sm:h-12 w-auto" />
                    <span class="text-base sm:text-lg md:text-xl font-semibold">Portal Informasi Karawang</span>
                </a>
            @endauth
        </div>
        <div class="auth-links flex items-center space-x-2 sm:space-x-4 w-full sm:w-auto justify-end">
            @guest
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1 sm:gap-2 bg-green-700 hover:bg-green-800 text-white px-3 sm:px-4 py-1.5 sm:py-2 rounded-full shadow transition-all duration-200 text-xs sm:text-sm">
                    {{-- Ikon Login Heroicons: Arrow Right On Rectangle --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 sm:w-5 h-4 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                    </svg>
                    <span class="hidden sm:inline">Login</span>
                </a>
            @else
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="inline-block bg-green-700 text-white px-3 sm:px-4 py-1.5 sm:py-2 rounded-full shadow hover:bg-green-800 transition duration-300 mr-4 text-xs sm:text-sm font-semibold">
                        Manage Cards
                    </a>
                @endif
                <div class="relative inline-block text-left">
                    <button type="button" class="flex items-center space-x-1 sm:space-x-2 focus:outline-none" id="user-menu-button" aria-expanded="true" aria-haspopup="true" onclick="document.getElementById('user-menu').classList.toggle('hidden')">
                        <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" alt="Profile" class="h-8 sm:h-10 w-8 sm:w-10 rounded-full object-cover border-4 border-green-700 shadow-md" />
                        <span class="user-name text-green-800 font-semibold ml-1 sm:ml-2 text-xs sm:text-base">{{ Auth::user()->name }}</span>
                        <svg class="w-3 sm:w-4 h-3 sm:h-4 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="user-menu" class="origin-top-right absolute right-0 mt-2 w-40 sm:w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-50">
                        <form method="POST" action="{{ route('logout') }}" class="p-2">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-xs sm:text-sm text-red-600 hover:bg-red-100 rounded-md font-semibold">Logout</button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </header>

    <section class="intro max-w-7xl mx-auto mt-6 mb-12 px-6 text-center">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-green-900 mb-4 tracking-tight pb-2 font-georgia">Portal Informasi Karawang</h1>
        <p class="text-lg text-gray-700 max-w-3xl mx-auto mb-8 leading-relaxed font-poppins">Temukan berbagai informasi penting, menarik, dan terkini seputar Karawang melalui portal ini.</p>
    </section>

    <section class="search-form max-w-xs sm:max-w-md md:max-w-lg mx-auto mb-12 px-4 sm:px-6" data-aos="fade-up" data-aos-delay="100">
        <form method="GET" action="{{ route('home') }}">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari informasi..." 
                    value="{{ request('search') }}" 
                    aria-label="Cari informasi"
                    class="w-full rounded-full px-4 sm:px-6 py-2 sm:py-3 text-base sm:text-lg transition bg-transparent"
                />
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-white rounded-full p-2 focus:outline-none transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                        </svg>
                    </button>
            </div>
        </form>
    </section>

    <main class="container max-w-7xl mx-auto px-6 pb-12">
        @yield('content')
    </main>

    <footer class="bg-green-100 text-center py-6 font-semibold text-green-900 border-t border-green-300 shadow-inner">
        &copy; {{ date('Y') }} Portal Informasi Karawang. All rights reserved.
    </footer>

    <script>
        AOS.init({
            duration: 900,
            easing: 'ease-in-out',
            once: true,
        });
    </script>
</body>
</html>
