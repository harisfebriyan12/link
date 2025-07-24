<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Livewire --}}
    @livewireStyles

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

{{-- Seluruh app dikelola AlpineJS --}}
<div x-data="sidebarState()" class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <aside :class="collapsed ? 'w-20' : 'w-64'" class="bg-white border-r border-gray-200 shadow-inner h-screen fixed top-0 left-0 z-20 transition-all duration-300">
        {{-- Sidebar akan mengakses 'collapsed' dari Alpine --}}
        @include('admin.partials.sidebar')
    </aside>

    {{-- Wrapper konten utama --}}
    <div :class="collapsed ? 'ml-20' : 'ml-64'" class="flex-1 flex flex-col transition-all duration-300 ml-64">

        {{-- Navbar --}}
        @include('admin.partials.navbar')

        {{-- Konten --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</div>

{{-- AlpineJS Logic --}}
<script>
    function sidebarState() {
        return {
            collapsed: JSON.parse(localStorage.getItem('sidebarCollapsed')) || false,
            toggle() {
                this.collapsed = !this.collapsed;
                localStorage.setItem('sidebarCollapsed', this.collapsed);
            }
        }
    }
</script>

@livewireScripts
</body>
</html>
