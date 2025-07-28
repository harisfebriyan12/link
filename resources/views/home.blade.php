@extends('layouts.app')
@section('content')
<div class="bg-white min-h-screen">
    {{-- Wave Separator --}}
    <div class="w-full -mt-10">
        <svg class="block w-full h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L60,213.3C120,203,240,181,360,186.7C480,192,600,224,720,229.3C840,235,960,213,1080,192C1200,171,1320,149,1380,138.7L1440,128L1440,0L0,0Z"></path>
        </svg>
    </div>

    {{-- Link Tree Section --}}
    <section class="max-w-lg mx-auto px-4 py-6">
        <div class="text-center mb-4">
            <h1 class="text-lg font-semibold text-gray-800">{{ $pageTitle ?? 'Link website' }}</h1>
            <div class="w-10 h-0.5 bg-green-900 mx-auto mt-1"></div>
        </div>

        @if ($cards->isEmpty())
            <p class="text-center text-gray-500 py-6 text-sm">{{ $emptyMessage ?? 'Belum ada link tersedia. Silakan kembali nanti!' }}</p>
        @else
            <div class="space-y-3">
                @foreach ($cards as $card)
                <a href="{{ $card->link ?? '#' }}" target="_blank" rel="noopener noreferrer"
                    class="block bg-gray-50 rounded-md border border-gray-200 overflow-hidden shadow hover:shadow-md transition duration-200">
                    <div class="flex items-center p-2">
                        {{-- Gambar --}}
                        <div class="w-8 h-8 rounded-md overflow-hidden bg-white border">
                            @if($card->gambar_url)
                                <img src="{{ $card->gambar_url }}" alt="{{ $card->judul }}" class="w-full h-full object-contain">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Konten --}}
                        <div class="ml-3 flex-1 flex justify-between items-center">
                            <div>
                                <h3 class="text-sm font-medium text-gray-800 truncate">{{ $card->judul }}</h3>
                                @if($card->deskripsi)
                                    <p class="text-sm font-medium text-gray-800 truncate">{{ $card->deskripsi }}</p>
                                @endif
                            </div>
                            @if($card->created_at)
                                <p class="text-xs text-gray-600">{{ $card->created_at->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $cards->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
