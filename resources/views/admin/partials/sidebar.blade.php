<aside class="w-64 bg-green-50 p-6 shadow-inner border-r border-green-200 min-h-screen">
    <nav class="flex flex-col space-y-4">
        <a href="{{ route('admin.home') }}" class="text-green-800 font-semibold hover:text-green-900 transition duration-200">Home</a>
        <a href="{{ url('/') }}" class="text-green-800 font-semibold hover:text-green-900 transition duration-200" target="_blank">View</a>
        <a href="{{ route('admin.manageCards') }}" class="text-green-800 font-semibold hover:text-green-900 transition duration-200">Manage Card</a>

        <div x-data="{ open: true }" class="relative">
            <button @click="open = !open" class="w-full text-left text-green-800 font-semibold hover:text-green-900 transition duration-200 focus:outline-none flex items-center justify-between">
                <span>Manage profile</span>
                <svg :class="{'transform rotate-180': open}" class="inline-block w-4 h-4 ml-1 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" @click.away="open = open" class="pl-12 mt-1 space-y-1">
                <a href="{{ route('profile.edit') }}" @click="open = false" class="block text-green-700 hover:text-green-900 transition duration-200">Setting Profile</a>
                <a href="{{ route('admin.manageUsers') }}" @click="open = false" class="block text-green-700 hover:text-green-900 transition duration-200">Manage User</a>
                <a href="{{ route('admin.changePassword') }}" @click="open = false" class="block text-green-700 hover:text-green-900 transition duration-200">Change Password</a>
                <a href="{{ route('profile.edit') }}#delete-account" @click="open = false" class="block text-green-700 hover:text-green-900 transition duration-200">Delete Account</a>
            </div>
        </div>

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();" class="text-green-800 font-semibold hover:text-green-900 transition duration-200 cursor-pointer">Logout</a>
        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </nav>
</aside>
