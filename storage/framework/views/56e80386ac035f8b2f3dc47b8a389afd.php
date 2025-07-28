<?php $__env->startSection('content'); ?>
    <!-- Include SweetAlert2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    
    <?php if(session('success')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Berhasil!',
                    text: "<?php echo e(session('success')); ?>",
                    icon: 'success',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg'
                    }
                });
            });
        </script>
    <?php endif; ?>

    
    <?php if(session('error')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Error!',
                    text: "<?php echo e(session('error')); ?>",
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg'
                    }
                });
            });
        </script>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="flex-1 p-4 sm:p-6 md:p-8">
        
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Kelola Link Website</h1>
            <p class="text-gray-600 text-sm sm:text-base">Kelola semua Link  dengan mudah</p>
        </div>

        
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 sm:p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <form action="<?php echo e(route('cards.index')); ?>" method="GET" class="relative w-full sm:flex-1 sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="searchInput" value="<?php echo e(request('search')); ?>"
                        class="w-full pl-10 pr-10 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 text-sm sm:text-base"
                        placeholder="Cari berdasarkan judul.">
                    <?php if(request('search')): ?>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <a href="<?php echo e(route('cards.index')); ?>" class="text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </form>
                <button onclick="openAddModal()"
    class="w-full sm:w-auto inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg text-sm sm:text-base">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
    </svg>
</button>
            </div>
        </div>

        
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100" id="cardsTable">
                    <thead class="bg-green-600">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider w-12">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Judul</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider hidden sm:table-cell">Deskripsi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider hidden md:table-cell">Gambar</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider hidden lg:table-cell">Link</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700" id="tableBody">
                        <?php $__empty_1 = true; $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-green-50/50" data-searchable="<?php echo e($card->id); ?>">
                                <td class="px-4 py-3 text-sm font-medium text-gray-600"><?php echo e($index + 1); ?></td>
                                <td class="px-4 py-3 font-semibold text-gray-900 text-sm"><?php echo e($card->judul); ?></td>
                                <td class="px-4 py-3 text-sm text-gray-600 max-w-xs hidden sm:table-cell">
                                    <p class="line-clamp-2"><?php echo e(\Illuminate\Support\Str::limit($card->deskripsi, 60)); ?></p>
                                    <?php if(strlen($card->deskripsi) > 60): ?>
                                        <button onclick="showFullDescription('<?php echo e($card->id); ?>')" class="text-green-600 hover:text-green-700 text-xs mt-1 font-medium">
                                            Lihat selengkapnya...
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell">
                                    <img src="<?php echo e($card->gambar ? asset('storage/' . $card->gambar) : asset('images/default-fallback.jpg')); ?>"
                                         alt="<?php echo e($card->judull); ?>"
                                         class="h-12 w-16 object-cover rounded-lg border border-gray-200 cursor-pointer"
                                         onclick="showImageModal('<?php echo e($card->gambar ? asset('storage/' . $card->gambar) : asset('images/default-fallback.jpg')); ?>', '<?php echo e($card->judul); ?>')" />
                                </td>
                                <td class="px-4 py-3 hidden lg:table-cell">
                                    <a href="<?php echo e($card->linkk); ?>" target="_blank"
                                       class="text-blue-600 hover:text-blue-700 font-medium text-sm">Lihat </a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openEditModal(<?php echo e($card->id); ?>)"
                                            class="p-2 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11.828 13H9v-2z" />
                                            </svg>
                                        </button>
                                        <form action="<?php echo e(route('cards.destroy', $card->id)); ?>" method="POST" class="inline-block" onsubmit="event.preventDefault(); confirmDelete('<?php echo e($card->judul); ?>', this);">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="p-2 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <div id="edit-modal-<?php echo e($card->id); ?>" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center hidden backdrop-blur-sm">
                                <div class="bg-white w-full max-w-md p-4 sm:p-6 rounded-lg shadow-xl relative max-h-[90vh] overflow-y-auto">
                                    <button onclick="closeEditModal(<?php echo e($card->id); ?>)"
                                            class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-lg font-bold w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-50">×</button>
                                    <div class="mb-4">
                                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Edit Data</h2>
                                        <p class="text-gray-600 text-sm">Perbarui informasi data</p>
                                    </div>
                                    <form action="<?php echo e(route('cards.update', $card->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-4" id="edit-form-<?php echo e($card->id); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div>
                                            <label class="block text-gray-700 text-sm font-semibold mb-1">Judul</label>
                                            <input type="text" name="judul" value="<?php echo e(old('judul', $card->judul)); ?>"
                                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 text-sm" required />
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 text-sm font-semibold mb-1">Deskripsi</label>
                                            <textarea name="deskripsi" rows="4"
                                                      class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 resize-none text-sm" required><?php echo e(old('deskripsi', $card->deskripsi)); ?></textarea>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 text-sm font-semibold mb-1">Gambar</label>
                                            <input type="file" name="gambar" accept="image/*"
                                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                                            <?php if($card->gambar): ?>
                                                <div class="mt-2">
                                                    <p class="text-xs text-gray-600 mb-1">Gambar saat ini:</p>
                                                    <img src="<?php echo e(asset('storage/' . $card->gambar)); ?>" alt="<?php echo e($card->judul); ?>"
                                                         class="rounded-lg max-h-24 object-cover border border-gray-200" />
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 text-sm font-semibold mb-1">Link Website</label>
                                            <input type="url" name="link" value="<?php echo e(old('linkk', $card->link)); ?>"
                                                   class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 text-sm" required />
                                        </div>
                                        <div class="flex justify-end gap-2 pt-4">
                                            <button type="button" onclick="closeEditModal(<?php echo e($card->id); ?>)"
                                                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg text-sm">Batal</button>
                                            <button type="submit"
                                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr id="noDataRow">
                                <td colspan="6" class="px-4 py-8 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="text-base font-medium text-gray-900 mb-2">Belum ada data</h3>
                                        <p class="text-gray-500 text-sm">Tambahkan data pertama Anda sekarang</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div id="add-modal" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center hidden backdrop-blur-sm">
            <div class="bg-white w-full max-w-md p-4 sm:p-6 rounded-lg shadow-xl relative max-h-[90vh] overflow-y-auto">
                <button onclick="closeAddModal()"
                        class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-lg font-bold w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-50">×</button>
                <div class="mb-4">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Tambah Data Baru</h2>
                    <p class="text-gray-600 text-sm">Buat data baru untuk website Anda</p>
                </div>
                <form action="<?php echo e(route('cards.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4" id="add-form">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1">Judul</label>
                        <input type="text" name="judul"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 text-sm"
                               required placeholder="Masukkan judul..." />
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                                  class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 resize-none text-sm"
                                  required placeholder="Masukkan deskripsi..."></textarea>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1">Gambar</label>
                        <input type="file" name="gambar" accept="image/*"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (maks. 5MB)</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1">Link Website</label>
                        <input type="url" name="link"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 text-sm"
                               required placeholder="https://example.com" />
                    </div>
                    <div class="flex justify-end gap-2 pt-4">
                        <button type="button" onclick="closeAddModal()"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg text-sm">Batal</button>
                        <button type="submit"
                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        
        <div id="image-modal" class="fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center hidden" onclick="closeImageModal()">
            <div class="relative max-w-3xl max-h-[80vh] p-4">
                <button onclick="closeImageModal()" class="absolute -top-8 right-0 text-white hover:text-gray-300 text-xl font-bold">×</button>
                <img id="modal-image" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-xl">
                <div class="text-center mt-2">
                    <h3 id="modal-title" class="text-white text-sm font-medium"></h3>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        function openEditModal(id) {
            document.getElementById('edit-modal-' + id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            focusFirstInput('edit-modal-' + id);

            // Add form validation
            const form = document.getElementById('edit-form-' + id);
            form.addEventListener('submit', function(e) {
                if (!validateEditForm(id)) {
                    e.preventDefault();
                }
            });
        }

        function closeEditModal(id) {
            document.getElementById('edit-modal-' + id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openAddModal() {
            document.getElementById('add-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            focusFirstInput('add-modal');

            // Add form validation
            const form = document.getElementById('add-form');
            form.addEventListener('submit', function(e) {
                if (!validateAddForm()) {
                    e.preventDefault();
                }
            });
        }

        function closeAddModal() {
            document.getElementById('add-modal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function showImageModal(imageSrc, title) {
            const modal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            const modalTitle = document.getElementById('modal-title');
            modalImage.src = imageSrc;
            modalTitle.textContent = title;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('image-modal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function confirmDelete(cardTitle, form) {
            Swal.fire({
                title: 'Konfirmasi Penghapusan',
                html: `Apakah Anda yakin ingin menghapus <strong>"${cardTitle}"</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg mr-2',
                    cancelButton: 'px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading();
                    form.submit();
                }
            });
        }

        function validateEditForm(id) {
            const form = document.getElementById('edit-form-' + id);
            const judul = form.querySelector('input[name="judul"]').value.trim();
            const deskripsi = form.querySelector('textarea[name="deskripsi"]').value.trim();
            const link = form.querySelector('input[name="link"]').value.trim();

            if (!judul || !deskripsi || !link) {
                Swal.fire({
                    title: 'Form Tidak Lengkap',
                    text: 'Harap isi semua kolom yang wajib diisi.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg'
                    }
                });
                return false;
            }

            try {
                new URL(link);
            } catch {
                Swal.fire({
                    title: 'Link Tidak Valid',
                    text: 'Harap masukkan URL yang valid (contoh: https://example.com)',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg'
                    }
                });
                return false;
            }

            return true;
        }

        function validateAddForm() {
            const form = document.getElementById('add-form');
            const judul = form.querySelector('input[name="judul"]').value.trim();
            const deskripsi = form.querySelector('textarea[name="deskripsi"]').value.trim();
            const link = form.querySelector('input[name="link"]').value.trim();

            if (!judul || !deskripsi || !link) {
                Swal.fire({
                    title: 'Form Tidak Lengkap',
                    text: 'Harap isi semua kolom yang wajib diisi.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg'
                    }
                });
                return false;
            }

            try {
                new URL(link);
            } catch {
                Swal.fire({
                    title: 'Link Tidak Valid',
                    text: 'Harap masukkan URL yang valid (contoh: https://example.com)',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg'
                    }
                });
                return false;
            }

            return true;
        }

        function showFullDescription(cardId) {
            const row = document.querySelector(`tr[data-searchable="${cardId}"]`);
            if (row) {
                const fullDesc = row.querySelector('td:nth-child(3) p').textContent;
                Swal.fire({
                    title: 'Deskripsi Lengkap',
                    text: fullDesc,
                    icon: 'info',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg'
                    }
                });
            }
        }

        function showLoading() {
            Swal.fire({
                title: 'Memproses...',
                html: 'Sedang memproses permintaan Anda',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('backdrop-blur-sm')) {
                document.querySelectorAll('[id*="modal"]').forEach(modal => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                });
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('[id*="modal"]').forEach(modal => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = 'auto';
                });
            }
            if (event.ctrlKey && event.key === 'f') {
                event.preventDefault();
                document.getElementById('searchInput').focus();
            }
            if (event.ctrlKey && event.key === 'n') {
                event.preventDefault();
                openAddModal();
            }
        });

        function focusFirstInput(modalId) {
            setTimeout(() => {
                const modal = document.getElementById(modalId);
                const firstInput = modal.querySelector('input[type="text"], textarea');
                if (firstInput) firstInput.focus();
            }, 100);
        }

        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    `;
                    submitBtn.disabled = true;
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 3000);
                }
            });
        });
    </script>

    <style>
        /* Scrollbar Styling */
        .max-h-\[90vh\]::-webkit-scrollbar {
            width: 6px;
        }
        .max-h-\[90vh\]::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .max-h-\[90vh\]::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        .max-h-\[90vh\]::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Text Truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Focus States */
        input:focus, textarea:focus, select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
        }

        /* Table Hover Effect */
        tbody tr:hover {
            background-color: rgba(34, 197, 94, 0.05);
        }

        /* Loading Spinner */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Backdrop Blur */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }

        /* Responsive Table Adjustments */
        @media (max-width: 640px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            thead {
                display: none;
            }
            tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #e5e7eb;
                border-radius: 0.5rem;
                padding: 1rem;
            }
            tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.5rem 0;
                border-bottom: 1px solid #e5e7eb;
            }
            tbody td:last-child {
                border-bottom: none;
            }
            tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #374151;
                margin-right: 1rem;
            }
            tbody td:nth-child(1):before { content: "No"; }
            tbody td:nth-child(2):before { content: "Judul"; }
            tbody td:nth-child(3):before { content: "Deskripsi"; }
            tbody td:nth-child(4):before { content: "Gambar"; }
            tbody td:nth-child(5):before { content: "Link"; }
            tbody td:nth-child(6):before { content: "Aksi"; }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\portalWebn\resources\views/cards/index.blade.php ENDPATH**/ ?>