@extends('layouts.admin')

@section('content')
    <div class="mb-10">
        <h1 class="text-4xl font-bold text-green-700 mb-4">Selamat Datang Di Halaman Admin,  {{ Auth::user()->name }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">

            <!-- Total Cards -->
            <div class="bg-white shadow-md rounded-xl p-6 border-l-4 border-green-600 hover:shadow-xl transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm text-gray-500">Total Users</h2>
                        <p class="text-2xl font-bold text-green-800 mt-1">{{ $totalUsers }}</p>
                    </div>
                    <div class="text-green-600 bg-green-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20 12H4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total data -->
            <div class="bg-white shadow-md rounded-xl p-6 border-l-4 border-green-600 hover:shadow-xl transition duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm text-gray-500">Total Data</h2>
                        <h1 class="text-2xl font-bold text-green-800 mt-1">{{ $totalCards }}</h1>
                    </div>
                    <div class="text-green-700 bg-green-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A4.992 4.992 0 007 21h10a4.992 4.992 0 001.879-3.196M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
