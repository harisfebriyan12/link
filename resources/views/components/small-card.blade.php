@if(!empty($card->link))
<a href="{{ $card->link }}" target="_blank" rel="noopener noreferrer" class="block transform transition duration-300 hover:scale-105 hover:shadow-lg max-w-[280px] rounded-xl border border-gray-300 shadow-md overflow-hidden">
@else
<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-300 max-w-[280px]">
@endif
    @if($card->gambar_url)
        <img 
            src="{{ $card->gambar_url }}" 
            alt="{{ $card->judul }}" 
            class="w-full h-40 object-cover rounded-t-xl"
        >
    @else
        <img 
            src="{{ asset('images/default-fallback.jpg') }}" 
            alt="Default Image" 
            class="w-full h-40 object-cover rounded-t-xl"
        >
    @endif
    <div class="p-6 flex flex-col h-full bg-white">
        <h3 class="text-2xl font-extrabold text-gray-900 mb-2 leading-snug truncate">
            {{ $card->judul }}
        </h3>
        <p class="text-gray-600 text-sm flex-grow leading-relaxed overflow-hidden">
            {{ \Illuminate\Support\Str::limit($card->deskripsi, 120) }}
        </p>
    </div>
@if(!empty($card->link))
</a>
@else
</div>
@endif
