@extends('layouts.admin')

@section('content')
    <h1 class="text-4xl font-extrabold text-green-900 mb-10 border-b-4 border-green-700 pb-3">Manage Users</h1>

    <div class="mb-6 flex justify-between">
        <a href="{{ url()->previous() }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">
            Back
        </a>
        <a href="{{ route('users.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
            Add New User
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
                    <th class="border border-gray-300 px-4 py-2 text-left bg-green-200">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left bg-green-200">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-left bg-green-200">Role</th>
                    <th class="border border-gray-300 px-4 py-2 text-left bg-green-200">Profile Photo</th>
                    <th class="border border-gray-300 px-4 py-2 text-left bg-green-200">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="hover:bg-green-50 cursor-pointer">
                        <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->role }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-16 w-auto object-cover rounded">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded mr-4 inline-block">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded inline-block">Delete</button>
                            </form>
                            <form action="{{ route('users.block', $user->id) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Are you sure you want to {{ $user->is_blocked ? 'unblock' : 'block' }} this user?');">
                                @csrf
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1 px-3 rounded inline-block">
                                    {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
