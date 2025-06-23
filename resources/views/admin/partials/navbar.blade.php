<header class="bg-white p-6 shadow-md flex flex-wrap items-center justify-between border-b border-gray-300">
    <div class="flex items-center space-x-4">
        <img src="{{ asset('storage/logo sidebar/logokrw.png') }}" alt="Logo" class="w-16 h-16 object-contain" />
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Portal Informasi Karawang</h1>
    </div>
    <div class="flex flex-wrap items-center space-x-6 mt-4 sm:mt-0 relative">
        @php
            $user = Auth::user();
            $profilePhotoUrl = $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4ade80&color=fff&size=48';
        @endphp

        <button @click="showUploadModal = true" title="Upload Profile Photo" class="relative w-12 h-12 rounded-full overflow-hidden border-4 border-green-700 hover:border-green-900 focus:outline-none focus:ring-4 focus:ring-green-700 transition">
            <img src="{{ $profilePhotoUrl }}" alt="Profile Photo" class="object-cover w-full h-full" />
            <div class="absolute bottom-0 right-0 bg-green-700 rounded-full p-2 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3h-1.586a1 1 0 00-.707.293l-1.414 1.414A1 1 0 0112.586 5H8a2 2 0 00-2 2v1h12V5a2 2 0 00-2-2z" />
                </svg>
            </div>
        </button>

        <div x-data="{ open: false, showUploadModal: false }" class="relative">
            <button @click="open = !open" class="bg-green-700 text-white px-6 py-3 rounded-md hover:bg-green-800 transition focus:outline-none focus:ring-4 focus:ring-green-700 flex items-center space-x-2 text-lg font-semibold">
                <span>Setting Profile</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg z-50 ring-1 ring-black ring-opacity-5">
                <a href="{{ route('admin.manageUsers') }}" class="block px-6 py-3 text-gray-800 hover:bg-green-100 transition text-lg font-medium">Manage User</a>
                <a href="{{ route('profile.edit') }}#update-password" class="block px-6 py-3 text-gray-800 hover:bg-green-100 transition text-lg font-medium">Change Password</a>
                <a href="{{ route('profile.edit') }}#delete-account" class="block px-6 py-3 text-gray-800 hover:bg-green-100 transition text-lg font-medium">Delete Account</a>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-700 text-white px-6 py-3 rounded-md hover:bg-red-800 transition focus:outline-none focus:ring-4 focus:ring-red-700 text-lg font-semibold">Logout</button>
        </form>
    </div>

    <!-- Upload Modal -->
    <div x-show="showUploadModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" style="display: none;">
        <div @click.away="showUploadModal = false" class="bg-white rounded-lg shadow-lg p-8 w-full max-w-lg mx-4">
            <h2 class="text-2xl font-semibold mb-6 text-gray-900">Upload Profile Photo</h2>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" x-ref="uploadForm">
                @csrf
                @method('PATCH')
                <input type="file" name="photo" accept="image/*" required class="mb-6 w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-4 focus:ring-green-700 text-lg" />
                <div class="flex justify-end space-x-4">
                    <button type="button" @click="showUploadModal = false" class="px-6 py-3 rounded-md bg-gray-300 hover:bg-gray-400 transition focus:outline-none text-lg font-semibold">Cancel</button>
                    <button type="submit" class="px-6 py-3 rounded-md bg-green-700 text-white hover:bg-green-800 transition focus:outline-none text-lg font-semibold">Upload</button>
                </div>
            </form>
        </div>
    </div>
</header>
