<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RequestAuthorController;
use Illuminate\Support\Facades\Route;

Route::get('/',[BlogController::class,'home'])->name('home');
Route::get('/about',[BlogController::class,'about'])->name('about');
Route::get('/blogs',[BlogController::class,'blogs'])->name('blogs');
Route::get('/contact',[BlogController::class,'contact'])->name('contact');
Route::post('/contact',[BlogController::class,'submitContact'])->name('contact.submit');
Route::get('/blog/{id}',[BlogController::class,'show'])->name('blog.show');
Route::post('/blog/{blog}/like',[BlogController::class,'toggleLike'])->name('blog.like.toggle');
Route::get('/blogs/filter', [BlogController::class, 'filterBlogs'])->name('blogs.filter');
Route::get('/blogs/category/{id}', [BlogController::class, 'filterByCategory']);
Route::get('/subscription', [BlogController::class, 'subscription'])->name('subscription');
Route::get('/subscription/payment/{plan}', [BlogController::class, 'paymentOptions'])->name('subscription.payment');
Route::post('/subscribe/{plan}', [BlogController::class, 'processSubscription'])->name('subscription.process');
Route::get('/subscription/thank-you', [BlogController::class, 'subscriptionThankYou'])->name('subscription.thank-you');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes (provided by Breeze)
require __DIR__.'/auth.php';

// User routes
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change');
});

// Author request routes (for regular users to become authors)
Route::middleware('auth')->prefix('author')->name('author.')->group(function () {
    Route::get('/request', [RequestAuthorController::class, 'show'])->name('request');
    Route::post('/request', [RequestAuthorController::class, 'request'])->name('request');
});

// Author routes
Route::middleware(['auth', 'author'])->prefix('author')->name('author.')->group(function () {
    Route::get('/blogs', [AuthorController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [AuthorController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [AuthorController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}/edit', [AuthorController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [AuthorController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [AuthorController::class, 'destroy'])->name('blogs.destroy');
});

require __DIR__.'/admin.php';
