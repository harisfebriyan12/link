@extends('layouts.admin')

@section('content')
<div>
    <main class="bg-white rounded-lg shadow-xl border border-gray-300 p-6 min-h-screen">
        <h1 class="text-4xl font-extrabold text-green-900 mb-10 border-b-4 border-green-700 pb-3">Admin Dashboard</h1>

        <div class="mb-8">
            <a href="{{ route('cards.create') }}" class="inline-block bg-green-700 text-white px-8 py-3 rounded-full shadow-lg hover:bg-green-800 transition duration-300 font-semibold text-lg">
                Tambah Card Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-8 p-5 bg-green-100 text-green-900 rounded-lg shadow-md text-center font-semibold text-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow-xl border border-gray-300">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-green-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wide">Judul</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wide">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wide">Gambar</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wide">Link</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-green-800 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($cards as $card)
                        <tr class="hover:bg-green-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-900">{{ $card->judul }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-800">{{ \Illuminate\Support\Str::limit($card->deskripsi, 70) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($card->gambar)
                                    <img src="{{ asset('storage/' . $card->gambar) }}" alt="{{ $card->judul }}" class="h-20 w-32 object-cover rounded-lg shadow-md" />
                                @else
                                    <img src="{{ asset('images/default-fallback.jpg') }}" alt="Default Image" class="h-20 w-32 object-cover rounded-lg shadow-md" />
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-700">
                                <a href="{{ $card->link }}" target="_blank" class="hover:underline font-medium">Lihat Link</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-4">
                                <a href="{{ route('cards.edit', $card->id) }}" class="text-green-700 hover:text-green-900 font-semibold px-3 py-1 rounded-lg border border-green-700 hover:bg-green-100 transition duration-200">Edit</a>
                                <form action="{{ route('cards.destroy', $card->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus card ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold px-3 py-1 rounded-lg border border-red-600 hover:bg-red-100 transition duration-200">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-green-700 font-semibold text-lg">Belum ada card tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
