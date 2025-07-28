<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">


<div x-data="sidebarState()" class="flex h-screen overflow-hidden">

    
    <aside :class="collapsed ? 'w-20' : 'w-64'" class="bg-white border-r border-gray-200 shadow-inner h-screen fixed top-0 left-0 z-20 transition-all duration-300">
        
        <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    
    <div :class="collapsed ? 'ml-20' : 'ml-64'" class="flex-1 flex flex-col transition-all duration-300 ml-64">

        
        <?php echo $__env->make('admin.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        
        <main class="flex-1 overflow-y-auto p-6">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</div>


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

<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/layouts/admin.blade.php ENDPATH**/ ?>