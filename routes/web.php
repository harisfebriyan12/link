<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\DB;

Route::get('/', [CardController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('cards', [CardController::class, 'index'])->name('cards.index');
    Route::resource('cards', CardController::class)->except(['index', 'show']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Temporary debug route to check card images
Route::get('/debug/cards-images', function () {
    return DB::table('cards')->select('judul', 'gambar')->get();
});

require __DIR__.'/auth.php';
