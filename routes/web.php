<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\SystemSettingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomePage\HomePageController;
use Illuminate\Support\Facades\Route;

// Beranda & Warta Publikasi
Route::get('/', [HomePageController::class, 'home'])->name('home');
Route::get('/berita-artikel/{slug}', [HomePageController::class, 'detailBerita'])->name('berita.show');
Route::post('/berita/{slug}/komentar', [HomePageController::class, 'storeComment'])->name('berita.comment.store');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected by auth middleware)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Artikel
    Route::resource('articles', ArticleController::class);

    // Manajemen Kategori & Tag
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroyCategory'])->name('categories.destroy');

    Route::post('/tags', [CategoryController::class, 'storeTag'])->name('tags.store');
    Route::delete('/tags/{tag}', [CategoryController::class, 'destroyTag'])->name('tags.destroy');

    // comment
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Pengaturan & Pemeliharaan Sistem
    Route::get('/settings', [SystemSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SystemSettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/backup', [SystemSettingController::class, 'backupDatabase'])->name('settings.backup');
});
