@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-blue-100 to-blue-200 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Judul dan Deskripsi dihapus karena sudah dipindah ke layout --}}
        {{-- <div class="text-center mb-12" data-aos="fade-down" data-aos-duration="1000">
            <h1 class="text-5xl font-extrabold text-[#1E3A8A] mb-4 tracking-tight drop-shadow-lg">Portal Informasi Karawang</h1>
            <p class="text-[#555] max-w-2xl mx-auto text-lg leading-relaxed">
                Temukan berbagai informasi penting, menarik, dan terkini seputar Karawang melalui portal ini.
            </p>
        </div> --}}

        {{-- Grid Card --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
            @foreach ($cards as $card)
                <div 
                    class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-2xl transition transform hover:scale-[1.05] duration-300"
                    data-aos="fade-up" data-aos-delay="100"
                >
                    {{-- Gambar Card --}}
                    <img 
                        src="{{ asset('storage/' . $card->gambar) }}" 
                        alt="{{ $card->judul }}" 
                        class="w-full h-56 object-cover"
                    >

                    {{-- Konten Card --}}
                    <div class="p-6 flex flex-col h-full">
                        <h2 class="text-2xl font-semibold text-[#1E3A8A] mb-3 leading-tight">
                            {{ $card->judul }}
                        </h2>
                        <p class="text-gray-700 text-base flex-grow leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($card->deskripsi, 140) }}
                        </p>
                        <a 
                            href="{{ $card->link }}" 
                            target="_blank" 
                            class="mt-6 inline-block bg-[#1E3A8A] text-white hover:bg-[#16326e] font-semibold py-3 px-6 rounded-lg shadow-sm transition duration-300 text-center"
                        >
                            Selengkapnya →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
