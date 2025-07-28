<header class="bg-white border-b border-gray-200 shadow-sm px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <!-- Left Section: Title -->
    <div class="flex items-center gap-4">

    </div>

    <!-- Right Section: User Actions -->
    <div class="flex items-center gap-4">
        <!-- User Profile (Optional) -->
        <div class="flex items-center gap-2">
            <span class="text-sm font-medium text-gray-600 hidden sm:block"><?php echo e(auth()->user()->email ?? 'email belum sinkron'); ?></span>
            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-semibold text-sm">
                <?php echo e(substr(auth()->user()->name ?? 'A', 0, 1)); ?>

            </div>
        </div>

        <!-- Logout Form -->
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-md transition-all duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h3a3 3 0 013 3v1"/>
                </svg>
            </button>
        </form>
    </div>
</header><?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/admin/partials/navbar.blade.php ENDPATH**/ ?>