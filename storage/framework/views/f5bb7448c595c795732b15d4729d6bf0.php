<?php $__env->startSection('content'); ?>
<div class="bg-white min-h-screen">
    
    <div class="w-full -mt-10">
        <svg class="block w-full h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L60,213.3C120,203,240,181,360,186.7C480,192,600,224,720,229.3C840,235,960,213,1080,192C1200,171,1320,149,1380,138.7L1440,128L1440,0L0,0Z"></path>
        </svg>
    </div>

    
    <section class="max-w-lg mx-auto px-4 py-6">
        <div class="text-center mb-4">
            <h1 class="text-lg font-semibold text-gray-800"><?php echo e($pageTitle ?? 'Link website'); ?></h1>
            <div class="w-10 h-0.5 bg-green-900 mx-auto mt-1"></div>
        </div>

        <?php if($cards->isEmpty()): ?>
            <p class="text-center text-gray-500 py-6 text-sm"><?php echo e($emptyMessage ?? 'Belum ada link tersedia. Silakan kembali nanti!'); ?></p>
        <?php else: ?>
            <div class="space-y-3">
                <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($card->link ?? '#'); ?>" target="_blank" rel="noopener noreferrer"
                    class="block bg-gray-50 rounded-md border border-gray-200 overflow-hidden shadow hover:shadow-md transition duration-200">
                    <div class="flex items-center p-2">
                        
                        <div class="w-8 h-8 rounded-md overflow-hidden bg-white border">
                            <?php if($card->gambar_url): ?>
                                <img src="<?php echo e($card->gambar_url); ?>" alt="<?php echo e($card->judul); ?>" class="w-full h-full object-contain">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="ml-3 flex-1 flex justify-between items-center">
                            <div>
                                <h3 class="text-sm font-medium text-gray-800 truncate"><?php echo e($card->judul); ?></h3>
                                <?php if($card->deskripsi): ?>
                                    <p class="text-sm font-medium text-gray-800 truncate"><?php echo e($card->deskripsi); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if($card->created_at): ?>
                                <p class="text-xs text-gray-600"><?php echo e($card->created_at->format('d M Y')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-4">
                <?php echo e($cards->links()); ?>

            </div>
        <?php endif; ?>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/home.blade.php ENDPATH**/ ?>