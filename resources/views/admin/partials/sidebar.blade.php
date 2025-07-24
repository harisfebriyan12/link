@php
    $activeRoute = Route::currentRouteName();
@endphp

<aside :class="open ? 'w-64' : 'w-0'" 
       class="bg-white border-r border-gray-200 shadow-xl transition-all duration-300 fixed inset-y-0 left-0 z-40 md:w-64 md:static md:shadow-lg min-h-screen overflow-hidden">

    <!-- Sidebar Content -->
    <div class="p-6 md:pt-8" x-show="open || window.innerWidth >= 768">
        <nav class="flex flex-col space-y-2 text-sm font-medium text-gray-700">
            <!-- Dashboard -->
            <a href="{{ route('admin.home') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 
               {{ $activeRoute === 'admin.home' ? 'bg-green-100 text-green-800 font-semibold shadow-sm' : 'hover:bg-green-50 hover:text-green-700' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"/>
                </svg>
                <span class="truncate">Dashboard</span>
            </a>

            <!-- Kelola Data -->
            <a href="{{ route('cards.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 
               {{ $activeRoute === 'cards.index' ? 'bg-green-100 text-green-800 font-semibold shadow-sm' : 'hover:bg-green-50 hover:text-green-700' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2h6v2m2 0a2 2 0 002-2V9a2 2 0 00-2-2H7a2 2 0 00-2 2v6a2 2 0 002 2h10z"/>
                </svg>
                <span class="truncate">Kelola Data</span>
            </a>
        </nav>
    </div>
</aside>