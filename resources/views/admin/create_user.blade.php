@extends('layouts.admin')

@section('content')
    <h1 class="text-4xl font-extrabold text-green-900 mb-10 border-b-4 border-green-700 pb-3">Add New User</h1>

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

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block font-semibold mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" />
            </div>

            <div>
                <label for="email" class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" />
            </div>

            <div>
                <label for="password" class="block font-semibold mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" />
            </div>

            <div>
                <label for="password_confirmation" class="block font-semibold mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" />
            </div>

            <div>
                <label for="profile_photo" class="block font-semibold mb-1">Profile Photo (optional)</label>
                <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                    class="w-full" />
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.manageUsers') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">
                    Back
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
