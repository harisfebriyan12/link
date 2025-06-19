@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Card</h1>

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cards.update', $card->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    @csrf
    @method('PUT')
    <div class="mb-6">
        <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $card->judul) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500" required />
    </div>
    <div class="mb-6">
        <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500" required>{{ old('deskripsi', $card->deskripsi) }}</textarea>
    </div>
    <div class="mb-6">
        <label for="gambar" class="block text-gray-700 font-semibold mb-2">Gambar</label>
        <input type="file" name="gambar" id="gambar" accept="image/*" class="w-full" />
        @if ($card->gambar)
            <img src="{{ asset('storage/' . $card->gambar) }}" alt="{{ $card->judul }}" class="mt-3 rounded-lg max-h-48 shadow-md" />
        @endif
    </div>
    <div class="mb-6">
        <label for="link" class="block text-gray-700 font-semibold mb-2">Link Eksternal</label>
        <input type="url" name="link" id="link" value="{{ old('link', $card->link) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500" required />
    </div>
    <div class="flex justify-between items-center max-w-lg mx-auto">
        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700 transition duration-300">Update</button>
    </div>
</form>
<form action="{{ route('cards.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus card ini?');" class="max-w-lg mx-auto mt-4">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg shadow hover:bg-red-700 transition duration-300 w-full">Hapus</button>
</form>
@endsection
