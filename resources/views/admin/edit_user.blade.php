@extends('layouts.admin')

@section('content')
    <h1 class="text-4xl font-extrabold text-green-900 mb-10 border-b-4 border-green-700 pb-3">Edit User</h1>

    <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
        @if ($errors->any())
            <div class="mb-6">
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-semibold mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" />
            </div>

            <div>
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" />
            </div>

            <div>
                <label for="password" class="block font-semibold mb-1">New Password (leave blank to keep current password)</label>
                <input type="password" name="password" id="password"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" />
            </div>

            <div>
                <label for="password_confirmation" class="block font-semibold mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" />
            </div>

            <div>
                <label for="profile_photo" class="block font-semibold mb-1">Profile Photo (optional)</label>
                <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                    class="w-full" />
                @if ($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-24 mt-2 rounded">
                @endif
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.manageUsers') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">
                    Back
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
