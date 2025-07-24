<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\DB;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.home');

Route::middleware(['auth'])->group(function () {
    Route::get('cards', [CardController::class, 'index'])->name('cards.index');
    Route::resource('cards', CardController::class)->except(['index', 'show']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.home');

    Route::get('/admin/manage-cards', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.manageCards');

    Route::get('/admin/manage-users', [App\Http\Controllers\AdminController::class, 'manageUsers'])->name('admin.manageUsers');

    Route::get('/admin/users/create', [App\Http\Controllers\AdminController::class, 'createUser'])->name('users.create');
    Route::get('/admin/users/{user}/edit', [App\Http\Controllers\AdminController::class, 'editUser'])->name('users.edit');
    Route::delete('/admin/users/{user}', [App\Http\Controllers\AdminController::class, 'destroyUser'])->name('users.destroy');

    Route::get('/admin/change-password', [App\Http\Controllers\AdminController::class, 'changePassword'])->name('admin.changePassword');

    Route::put('/admin/change-password', [App\Http\Controllers\AdminController::class, 'updatePassword'])->name('admin.updatePassword');
});

// Temporary debug route to check card images
Route::get('/debug/cards-images', function () {
    return DB::table('cards')->select('judul', 'gambar')->get();
});

require __DIR__.'/auth.php';
