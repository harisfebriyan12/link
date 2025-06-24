<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Portal Informasi Karawang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-poppins min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <div class="mb-6 text-center">
            <img src="{{ asset('storage/logo sidebar/logokrw.png') }}" alt="Logo" class="mx-auto h-16 w-auto object-contain" />
            <h1 class="text-3xl font-semibold text-green-900 mt-4">Portal Informasi Karawang</h1>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition" />
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent transition" />
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center text-gray-700">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" />
                    <span class="ml-2 text-sm">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-green-700 hover:text-green-900 underline">Forgot your password?</a>
                @endif
            </div>

            <button type="submit" class="w-full bg-green-700 hover:bg-green-800 text-white font-semibold py-3 rounded-md transition duration-300">
                Log in
            </button>
        </form>

        @if (Route::has('register'))
            <p class="mt-6 text-center text-gray-600 text-sm">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-green-700 hover:text-green-900 underline font-semibold">Register</a>
            </p>
        @endif
    </div>
</body>
</html>
