@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Card Baru</h1>

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    @csrf
    <div class="mb-4">
        <label for="judul" class="block font-semibold mb-1">Judul</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>
    <div class="mb-4">
        <label for="deskripsi" class="block font-semibold mb-1">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ old('deskripsi') }}</textarea>
    </div>
    <div class="mb-4">
        <label for="gambar" class="block font-semibold mb-1">Gambar</label>
        <input type="file" name="gambar" id="gambar" accept="image/*" class="w-full" required />
    </div>
    <div class="mb-4">
        <label for="link" class="block font-semibold mb-1">Link Eksternal</label>
        <input type="url" name="link" id="link" value="{{ old('link') }}" class="w-full border border-gray-300 rounded px-3 py-2" required />
    </div>
    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </div>
</form>
@endsection
