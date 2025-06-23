@extends('layouts.admin')

@section('content')
<div>
    <main class="bg-white rounded-lg shadow-xl border border-gray-300 p-6 min-h-screen">
        <h1 class="text-4xl font-extrabold text-green-900 mb-10 border-b-4 border-green-700 pb-3">Visitor Statistics</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4">Jumlah Pengunjung Saat Ini</h2>
            <p class="text-lg font-bold">{{ $visitorCount }}</p>
            <!-- Add charts or more detailed stats here -->
        </div>
    </main>
</div>
@endsection
    