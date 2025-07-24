@extends('layouts.admin')

@section('content')
    <!-- Include SweetAlert2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include Alpine.js for sidebar -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- SweetAlert Success Popup --}}
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    willClose: () => {
                        document.body.style.overflow = 'auto';
                    }
                });
            });
        </script>
    @endif

    {{-- SweetAlert Error Popup --}}
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    willClose: () => {
                        document.body.style.overflow = 'auto';
                    }
                });
            });
        </script>
    @endif

        <!-- Main Content -->
        <div class="flex-1 p-6 md:p-8">
            {{-- Page Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Kelola Data</h1>
                <p class="text-gray-600">Kelola semua Data</p>
            </div>

            {{-- Controls Section --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                    <form action="{{ route('data.index') }}" method="GET" class="relative flex-1 max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50"
                            placeholder="Cari berdasarkan ">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            @if(request('search'))
                                <a href="{{ route('data.index') }}" class="text-gray-400 hover:text-gray-600 ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </form>
                    <div class="flex items-center gap-3">
                        <button onclick="openAddModal()"
                            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2.5 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Simplified Table --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100" id="dataTable">
                        <thead class="bg-green-600">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider w-16">No</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Link</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700" id="tableBody">
                            @forelse ($data as $index => $card)
                                <tr class="hover:bg-green-50/50" data-searchable="{{ $card->id }}">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-600">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 text-sm">{{ $card->judul }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                                        <p class="line-clamp-2">{{ \Illuminate\Support\Str::limit($card->deskripsi, 80) }}</p>
                                        @if(strlen($card->deskripsi) > 80)
                                            <button onclick="showFullDescription('{{ $card->id }}')" class="text-green-600 hover:text-green-700 text-xs mt-1 font-medium">
                                                Lihat selengkapnya...
                                            </button>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <img src="{{ $card->gambar ? asset('storage/' . $card->gambar) : asset('images/default-fallback.jpg') }}"
                                             alt="{{ $card->judul }}"
                                             class="h-16 w-24 object-cover rounded-lg border border-gray-200 cursor-pointer"
                                             onclick="showImageModal('{{ $card->gambar ? asset('storage/' . $card->gambar) : asset('images/default-fallback.jpg') }}', '{{ $card->judul }}')" />
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ $card->link }}" target="_blank"
                                           class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-medium text-sm">
                                            <span>Lihat Website</span>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <button onclick="openEditModal({{ $card->id }})"
                                                class="p-2 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536M9 11l6.586-6.586a2 2 0 112.828 2.828L11.828 13H9v-2z" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('data.destroy', $data->id) }}" method="POST" class="inline-block" onsubmit="event.preventDefault(); confirmDelete('{{ $card->judull }}', this);">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <div id="edit-modal-{{ $card->id }}" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center hidden backdrop-blur-sm">
                                    <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-2xl relative max-h-[90vh] overflow-y-auto">
                                        <button onclick="closeEditModal({{ $card->id }})"
                                                class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-xl font-bold z-10 w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-50">×</button>
                                        <div class="mb-6">
                                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Edit Data</h2>
                                            <p class="text-gray-600">Perbarui informasi Data yang dipilih</p>
                                        </div>
                                        <form action="{{ route('cards.update', $card->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" onsubmit="return validateForm(this);">
                                            @csrf
                                            @method('PUT')
                                            <div>
                                                <label class="block text-gray-700 text-sm font-semibold mb-2">Judul</label>
                                                <input type="text" name="judul" value="{{ old('judul', $card->judul) }}"
                                                       class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50" required />
                                            </div>
                                            <div>
                                                <label class="block text-gray-700 text-sm font-semibold mb-2">Deskripsi</label>
                                                <textarea name="deskripsi" rows="4"
                                                          class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 resize-none" required>{{ old('deskripsi', $card->deskripsi) }}</textarea>
                                            </div>
                                            <div>
                                                <label class="block text-gray-700 text-sm font-semibold mb-2">Gambar</label>
                                                <input type="file" name="gambar" accept="image/*"
                                                       class="w-full border border-gray-200 rounded-lg px-4 py-3 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                                                @if ($card->gambar)
                                                    <div class="mt-3">
                                                        <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                                        <img src="{{ asset('storage/' . $card->gambar) }}" alt="{{ $card->judul }}"
                                                             class="rounded-lg shadow-md max-h-32 object-cover border border-gray-200" />
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <label class="block text-gray-700 text-sm font-semibold mb-2">Link Website</label>
                                                <input type="url" name="link" value="{{ old('link', $card->link) }}"
                                                       class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50" required />
                                            </div>
                                            <div class="flex justify-end gap-3 pt-4">
                                                <button type="button" onclick="closeEditModal({{ $card->id }})"
                                                        class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg">Batal</button>
                                                <button type="submit"
                                                        class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr id="noDataRow">
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data</h3>
                                            <p class="text-gray-500 mb-4">Mulai dengan menambahkan Data pertama Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Tambah --}}
            <div id="add-modal" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center hidden backdrop-blur-sm">
                <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-2xl relative max-h-[90vh] overflow-y-auto">
                    <button onclick="closeAddModal()"
                            class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-xl font-bold w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-50">×</button>
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Tambah Data Baru</h2>
                        <p class="text-gray-600">Buat data baru untuk website Anda</p>
                    </div>
                    <form action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" onsubmit="return validateForm(this);">
                        @csrf
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Judul</label>
                            <input type="text" name="judul"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50"
                                   required placeholder="Masukkan judul card..." />
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                      class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 resize-none"
                                      required placeholder="Masukkan deskripsi card..."></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Gambar</label>
                            <input type="file" name="gambar" accept="image/*"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-3 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF (maksimal 5MB)</p>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Link Website</label>
                            <input type="url" name="link"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50"
                                   required placeholder="https://example.com" />
                        </div>
                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" onclick="closeAddModal()"
                                    class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg">Batal</button>
                            <button type="submit"
                                    class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg">Simpan Card</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Image Preview Modal --}}
            <div id="image-modal" class="fixed inset-0 z-50 bg-black bg-opacity-80 flex items-center justify-center hidden" onclick="closeImageModal()">
                <div class="relative max-w-4xl max-h-[90vh] p-4">
                    <button onclick="closeImageModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300 text-2xl font-bold">×</button>
                    <img id="modal-image" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                    <div class="text-center mt-4">
                        <h3 id="modal-title" class="text-white font-semibold"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        function openEditModal(id) {
            document.getElementById('edit-modal-' + id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal(id) {
            document.getElementById('edit-modal-' + id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openAddModal() {
            document.getElementById('add-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            focusFirstInput('add-modal');
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
                text: `Apakah Anda yakin ingin menghapus Data "${cardTitle}"? Tindakan ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showConfirmButton: true,
                confirmButtonText: 'Hapus',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg mr-2',
                    cancelButton: 'px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function validateForm(form) {
            const judul = form.querySelector('input[name="judul"]').value.trim();
            const deskripsi = form.querySelector('textarea[name="deskripsi"]').value.trim();
            const link = form.querySelector('input[name="link"]').value.trim();

            if (!judul || !deskripsi || !link) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Semua kolom wajib diisi (Judul, Deskripsi, Link Website).',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    willClose: () => {
                        document.body.style.overflow = 'auto';
                    }
                });
                return false;
            }

            // Additional URL validation
            try {
                new URL(link);
            } catch {
                Swal.fire({
                    title: 'Error!',
                    text: 'Link Website harus berupa URL yang valid (contoh: https://example.com).',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    willClose: () => {
                        document.body.style.overflow = 'auto';
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
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    willClose: () => {
                        document.body.style.overflow = 'auto';
                    }
                });
            }
        }

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('backdrop-blur-sm')) {
                const modals = document.querySelectorAll('[id*="modal"]');
                modals.forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        modal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }
                });
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('[id*="modal"]');
                modals.forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        modal.classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }
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
                if (submitBtn && !this.onsubmit) { // Skip if validateForm is present
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menyimpan...
                    `;
                    submitBtn.disabled = true;
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 5000);
                }
            });
        });
    </script>

    <style>
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
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }
        tbody tr:hover {
            background-color: rgba(34, 197, 94, 0.05);
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
        .swal2-loader {
            border-color: #3b82f6 !important;
            border-bottom-color: transparent !important;
        }
    </style>
@endsection