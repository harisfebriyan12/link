@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen">
    {{-- Wave Separator --}}
    <div class="w-full -mt-10">
        <svg class="block w-full h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L60,213.3C120,203,240,181,360,186.7C480,192,600,224,720,229.3C840,235,960,213,1080,192C1200,171,1320,149,1380,138.7L1440,128L1440,0L0,0Z"></path>
        </svg>
    </div>

    {{-- Link Tree Section --}}
    <section class="max-w-md mx-auto px-4 py-8">
        {{-- Title Section --}}
        <div class="text-center mb-6">
            <h1 class="text-xl font-bold text-gray-800 mb-1">{{ $pageTitle ?? 'DIS A' }}</h1>
            <p class="text-sm text-gray-600">{{ $pageSubtitle ?? 'Daftar link terbaru' }}</p>
            <div class="mt-2">
                <div class="w-12 h-0.5 bg-gray-300 mx-auto"></div>
            </div>
        </div>

        @if ($cards->isEmpty())
            <p class="text-center text-gray-500 py-6 text-sm">{{ $emptyMessage ?? 'Belum ada link tersedia. Silakan kembali nanti!' }}</p>
        @else
            <div class="space-y-3">
                @foreach ($cards as $card)
                <div class="transition-transform duration-200 hover:scale-[1.02]">
                    <a href="{{ $card->link ?? '#' }}" target="_blank" rel="noopener noreferrer"
                        class="block bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center p-4">
                            {{-- Gambar --}}
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-50 border border-gray-100">
                                    @if($card->gambar)
                                    <img src="{{ $card->gambar_url }}" 
                                         alt="{{ $card->judul }}"
                                         class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Konten --}}
                            <div class="ml-4 flex-1 min-w-0">
                                <h3 class="text-sm font-semibold text-gray-900 truncate">
                                    {{ $card->judul }}
                                </h3>
                          
                                @if($card->deskripsi)
                                <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $card->deskripsi }}</p>
                                @endif
                                <p class="text-xs text-gray-400 mt-1.5">
                                    <span class="inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $card->created_at->translatedFormat('d M Y') }}
                                    </span>
                                </p>
                            </div>
                            
                            {{-- Icon panah --}}
                            <div class="ml-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection