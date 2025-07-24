<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Portal Informasi Karawang</title>

  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
</head>
<body class="bg-white text-green-900 min-h-screen font-poppins m-0 p-0 overflow-x-hidden" x-data="{ mobileMenuOpen: false }">

      <!-- 👤 Auth Area -->
      <div class="flex items-center gap-4">
        <?php if(auth()->guard()->guest()): ?>
        <?php else: ?>
          <div class="relative">
            <button @click="document.getElementById('user-menu-card').classList.toggle('hidden')" class="flex items-center gap-2 text-white focus:outline-none">
              <img src="<?php echo e(Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name)); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="h-8 w-8 rounded-full border-2 border-white shadow" />
              <span class="text-sm"><?php echo e(Auth::user()->name); ?></span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- Dropdown -->
            <div id="user-menu-card" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-md shadow-lg z-50 overflow-hidden border">
              <?php if(Auth::user()->role === 'admin'): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-4 py-2 text-sm text-green-700 hover:bg-green-50"> Kembali</a>
              <?php endif; ?>
              <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-100">Logout</button>
              </form>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- 📱 Mobile Menu -->
  <div x-show="mobileMenuOpen" class="sm:hidden fixed top-16 left-0 w-full bg-gradient-to-r from-green-600 to-green-800 z-40">
    <nav class="flex flex-col p-4 space-y-2 text-white">
      <a href="<?php echo e(url('/')); ?>" class="hover:text-green-200">Home</a>
      <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->role === 'admin'): ?>
          <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-green-200">Dashboard Admin</a>
        <?php else: ?>
          <a href="<?php echo e(url('/profile')); ?>" class="hover:text-green-200">Profile</a>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" class="text-left hover:text-red-300">Logout</button>
        </form>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="hover:text-green-200">Login</a>
      <?php endif; ?>
    </nav>
  </div>

  <!-- 📄 Konten Utama -->
  <main class="pt-24 px-4 sm:px-6">
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <!-- 🌟 Scripts -->
  <script>
    AOS.init({
      duration: 900,
      easing: 'ease-in-out',
      once: true,
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/layouts/app.blade.php ENDPATH**/ ?>