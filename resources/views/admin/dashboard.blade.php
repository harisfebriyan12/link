@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold text-green-800 mb-8">Admin Dashboard</h1>

    <div class="mb-6">
        <a href="{{ route('cards.create') }}" class="inline-block bg-green-700 text-white px-6 py-3 rounded-full shadow hover:bg-green-800 transition duration-300">
            Tambah Card Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-green-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Link</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-green-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($cards as $card)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-900">{{ $card->judul }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-800">{{ \Illuminate\Support\Str::limit($card->deskripsi, 50) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="{{ asset('storage/' . $card->gambar) }}" alt="{{ $card->judul }}" class="h-16 w-24 object-cover rounded" />
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                            <a href="{{ $card->link }}" target="_blank" class="hover:underline">Lihat Link</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                            <a href="{{ route('cards.edit', $card->id) }}" class="text-green-700 hover:text-green-900 font-semibold">Edit</a>
                            <form action="{{ route('cards.destroy', $card->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus card ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-green-700 font-semibold">Belum ada card tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
