<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Portal Informasi Karawang</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
        <!-- Logo (jika ada) -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Login</h2>
        </div>

        <!-- Flash Message -->
        <?php if(session('status')): ?>
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4" id="loginForm">
            <?php echo csrf_field(); ?>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" />
            </div>

            <!-- Google reCAPTCHA -->
            <div>
                <div class="g-recaptcha" data-sitekey="<?php echo e(env('RECAPTCHA_SITE_KEY')); ?>"></div>
            </div>

            <!-- Submit -->
            <div>
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                    Masuk
                </button>
            </div>
        </form>
    </div>

    <!-- Script Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- JavaScript untuk SweetAlert -->
    <script>
        // Pastikan SweetAlert2 sudah dimuat
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 tidak dimuat dengan benar.');
        }

        // Validasi CAPTCHA sebelum submit
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            const recaptchaResponse = grecaptcha.getResponse();
            if (!recaptchaResponse) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'CAPTCHA Belum Diverifikasi',
                    text: 'Silakan verifikasi CAPTCHA sebelum melanjutkan.',
                    confirmButtonColor: '#16a34a',
                });
            }
        });

        // Tampilkan SweetAlert untuk error autentikasi
        <?php if($errors->has('email') || $errors->has('password')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: 'Email atau kata sandi salah. Silakan coba lagi.',
                confirmButtonColor: '#16a34a',
            });
        <?php endif; ?>
    </script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/auth/login.blade.php ENDPATH**/ ?>