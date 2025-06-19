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

<form action="{{ route('cards.update', $card->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="judul" class="block font-semibold mb-1">Judul</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $card->judul) }}" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>
    <div class="mb-4">
        <label for="deskripsi" class="block font-semibold mb-1">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ old('deskripsi', $card->deskripsi) }}</textarea>
    </div>
    <div class="mb-4">
        <label for="gambar" class="block font-semibold mb-1">Gambar</label>
        <input type="file" name="gambar" id="gambar" accept="image/*" class="w-full" />
        @if ($card->gambar)
            <img src="{{ asset('storage/' . $card->gambar) }}" alt="{{ $card->judul }}" class="mt-2 rounded max-h-48" />
        @endif
    </div>
    <div class="mb-4">
        <label for="link" class="block font-semibold mb-1">Link Eksternal</label>
        <input type="url" name="link" id="link" value="{{ old('link', $card->link) }}" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>
    <div class="flex justify-end space-x-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <form action="{{ route('cards.destroy', $card->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus card ini?');" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Hapus</button>
        </form>
    </div>
</form>
@endsection
