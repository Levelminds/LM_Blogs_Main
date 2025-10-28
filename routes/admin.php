<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SeoController;

// -------------------------------
// Admin Authentication
// -------------------------------
Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// -------------------------------
// Protected Admin Routes
// -------------------------------
Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Blog Management
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    // SEO Settings
    Route::get('/seo', [SeoController::class, 'edit'])->name('seo.edit');
    Route::put('/seo', [SeoController::class, 'update'])->name('seo.update');
});
