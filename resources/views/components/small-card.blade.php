<div 
    class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-300 hover:shadow-lg transition transform hover:scale-105 duration-200 max-w-[310px] max-h-[200px]"
    data-aos="fade-up" data-aos-delay="100"
>
    <img 
        src="{{ $card->gambar }}" 
        alt="{{ $card->judul }}" 
        class="w-full h-28 object-cover"
    >
    <div class="p-4 flex flex-col h-full">
        <h3 class="text-lg font-semibold text-gray-800 mb-2 leading-tight truncate">
            {{ $card->judul }}
        </h3>
        <p class="text-gray-600 text-sm flex-grow leading-relaxed truncate">
            {{ \Illuminate\Support\Str::limit($card->deskripsi, 80) }}
        </p>
    </div>
</div>
