@extends('layouts.admin')

@section('content')
<h1 class="text-4xl font-extrabold text-green-900 mb-10 border-b-4 border-green-700 pb-3">Change Password</h1>

@if(session('success'))
    <div class="mb-8 p-5 bg-green-100 text-green-900 rounded-lg shadow-md text-center font-semibold text-lg">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.updatePassword') }}" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    @csrf
    @method('PUT')

    <div class="mb-6">
        <label for="current_password" class="block text-gray-700 font-semibold mb-2">Current Password</label>
        <input type="password" name="current_password" id="current_password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500" required />
    </div>

    <div class="mb-6">
        <label for="new_password" class="block text-gray-700 font-semibold mb-2">New Password</label>
        <input type="password" name="new_password" id="new_password" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500" required />
    </div>

    <div class="mb-6">
        <label for="new_password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500" required />
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg shadow hover:bg-green-700 transition duration-300">Update Password</button>
    </div>
</form>
@endsection
