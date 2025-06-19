@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-blue-100 to-blue-200 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-0 sm:px-2 lg:px-4">
        {{-- Judul dan Deskripsi dihapus karena sudah dipindah ke layout --}}

        {{-- Grid Card --}}
        {{-- Bagian kartu besar dihapus sesuai permintaan --}}

        {{-- Small Cards Section --}}
        <div class="mt-16">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                @foreach ($cards->take(10) as $card)
                    @php
                        $card->gambar = asset('storage/' . $card->gambar);
                    @endphp
                    @include('components.small-card', ['card' => $card])
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
