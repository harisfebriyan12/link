@extends('layouts.admin')

@section('content')
    <h1 class="text-4xl font-extrabold text-green-900 mb-10 border-b-4 border-green-700 pb-3">Admin Home</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-4">Visitor Statistics</h2>
        <p class="text-lg">Jumlah pengunjung saat ini: <span class="font-bold">{{ $visitorCount }}</span></p>
        <!-- Simple SVG bar chart example -->
        <svg width="400" height="150" class="mt-6" aria-label="Visitor statistics bar chart" role="img">
            <rect x="10" y="50" width="50" height="100" fill="#34d399" />
            <rect x="70" y="30" width="50" height="120" fill="#059669" />
            <rect x="130" y="70" width="50" height="80" fill="#10b981" />
            <rect x="190" y="40" width="50" height="110" fill="#047857" />
            <rect x="250" y="60" width="50" height="90" fill="#065f46" />
            <text x="10" y="145" font-size="12" fill="#065f46">Mon</text>
            <text x="70" y="145" font-size="12" fill="#065f46">Tue</text>
            <text x="130" y="145" font-size="12" fill="#065f46">Wed</text>
            <text x="190" y="145" font-size="12" fill="#065f46">Thu</text>
            <text x="250" y="145" font-size="12" fill="#065f46">Fri</text>
        </svg>
    </div>
@endsection
