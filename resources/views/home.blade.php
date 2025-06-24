@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-2">Portal Informasi Karawang</h1>
    <p class="text-lg mb-4">Temukan berbagai informasi penting, menarik, dan terkini seputar Karawang melalui portal ini.</p>

    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Statistics</h2>
        <div class="grid grid-cols-2 gap-4 max-w-md">
            <div class="p-4 bg-green-100 rounded shadow text-center">
                <div class="text-3xl font-bold text-green-800">{{ $cardsCount ?? 0 }}</div>
                <div class="text-green-700">Total Cards</div>
            </div>
            <div class="p-4 bg-green-100 rounded shadow text-center">
                <div class="text-3xl font-bold text-green-800">{{ $visitorCount ?? 0 }}</div>
                <div class="text-green-700">Visitors</div>
            </div>
        </div>
    </div>

    {{-- Placeholder for card chart --}}
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Card Chart</h2>
        <p>Chart visualization will be implemented here.</p>
    </div>

    <input type="text" placeholder="Cari informasi..." class="w-full mb-6 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

    <div class="space-y-4">
        <p>sadsdgfgfgdfsdf</p>
        <p>sadsdgfgfgdfsdf</p>
        <p>dfffgdfgdg</p>
        <p>asdkskjsd</p>
        <p>asdkskjsd</p>
        <p>sadasfghgjiuygvc</p>
        <p>Yogyakarta</p>
        <p>Yogyakarta</p>
        <p>jhasdjhasdjhasdjashj</p>
    </div>
</div>
@endsection
