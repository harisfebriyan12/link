@extends('layouts.admin')

@section('content')
<h1 class="text-4xl font-extrabold text-green-900 mb-10 border-b-4 border-green-700 pb-3">Manage Users</h1>

<div class="mb-8">
    <a href="{{ route('users.create') }}" class="inline-block bg-green-700 text-white px-8 py-3 rounded-full shadow-lg hover:bg-green-800 transition duration-300 font-semibold text-lg">
        Tambah User Baru
    </a>
</div>

@if(session('success'))
    <div class="mb-8 p-5 bg-green-100 text-green-900 rounded-lg shadow-md text-center font-semibold text-lg">
        {{ session('success') }}
    </div>
@endif

<!-- User list table -->
<table class="min-w-full divide-y divide-gray-300 bg-white rounded-lg shadow-xl border border-gray-300">
    <thead class="bg-green-100">
        <tr>
            <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wide">Nama</th>
            <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wide">Email</th>
            <th class="px-6 py-4 text-left text-sm font-semibold text-green-800 uppercase tracking-wide">Role</th>
            <th class="px-6 py-4 text-center text-sm font-semibold text-green-800 uppercase tracking-wide">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse ($users as $user)
            <tr class="hover:bg-green-50 transition duration-200">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-900">{{ $user->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-800">{{ $user->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-800">{{ $user->role }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-4">
                    <a href="{{ route('users.edit', $user->id) }}" class="text-green-700 hover:text-green-900 font-semibold px-3 py-1 rounded-lg border border-green-700 hover:bg-green-100 transition duration-200">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold px-3 py-1 rounded-lg border border-red-600 hover:bg-red-100 transition duration-200">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-6 text-center text-green-700 font-semibold text-lg">Belum ada user tersedia.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
