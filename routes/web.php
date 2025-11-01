<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\StorageProxyController;
use Illuminate\Support\Facades\Route;

Route::get('/storage/{path}', StorageProxyController::class)
    ->where('path', '.*')
    ->name('storage.proxy');

// -------------------------------
// Static Pages (Landing Sections)
// -------------------------------
Route::get('/', function () {
    return view('pages.home');
})->name('home');
Route::view('/team', 'pages.team')->name('team');
Route::view('/tour', 'pages.tour')->name('tour');
Route::get('/careers', [CareerController::class, 'show'])->name('careers');
Route::post('/careers', [CareerController::class, 'submit'])->name('careers.submit');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// -------------------------------
// Blog Routes
// -------------------------------
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/category/{slug}', [BlogController::class, 'category'])->name('blog.category');

// -------------------------------
// Likes & Subscriptions
// -------------------------------
Route::post('/blog/{blog}/like', [LikeController::class, 'toggle'])->name('blog.like');

// Subscription routes
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
Route::get('/subscribe/confirm/{token}', [SubscriptionController::class, 'confirm'])->name('subscribe.confirm');
Route::post('/blog/subscribe', [SubscriptionController::class, 'store'])->name('blog.subscribe');

require __DIR__ . '/admin.php';
