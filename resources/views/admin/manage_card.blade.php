@extends('layouts.admin')

@section('content')
    <h1 class="text-4xl font-extrabold text-green-900 mb-10 border-b-4 border-green-700 pb-3">Manage Cards</h1>

    <div class="mb-6">
        <a href="{{ route('cards.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
            Add New Card
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow-md p-6">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-green-100">
                    <th class="border border-gray-300 px-4 py-2 text-left bg-green-200">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left bg-green-200">Title</th>
                    <th class="border border-gray-300 px-4 py-2 text-left bg-green-200">Image</th>
                    <th class="border border-gray-300 px-4 py-2 text-left bg-green-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cards as $card)
                    <tr class="hover:bg-green-100 hover:shadow-lg transition duration-300 ease-in-out cursor-pointer">
                        <td class="border border-gray-300 px-4 py-2">{{ $card->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $card->judul }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($card->gambar)
                                <img src="{{ asset('storage/' . $card->gambar) }}" alt="{{ $card->judul }}" class="h-16 w-auto object-cover rounded">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('cards.edit', $card->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded mr-2 inline-block">Edit</a>
                            <form action="{{ route('cards.destroy', $card->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this card?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded inline-block">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">No cards found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
