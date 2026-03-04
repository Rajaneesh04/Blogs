<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;


Route::get('/',[BlogController::class,'home'])->name('home');
Route::get('/about',[BlogController::class,'about'])->name('about');
Route::get('/blogs',[BlogController::class,'blogs'])->name('blogs');
Route::get('/contact',[BlogController::class,'contact'])->name('contact');
Route::post('/contact',[BlogController::class,'submitContact'])->name('contact.submit');
Route::get('/blog/{id}',[BlogController::class,'show'])->name('blog.show');
Route::post('/blog/{blog}/like',[BlogController::class,'toggleLike'])->name('blog.like.toggle');
Route::get('/blogs/filter', [BlogController::class, 'filterBlogs'])->name('blogs.filter');
Route::get('/blogs/category/{id}', [BlogController::class, 'filterByCategory']);

require __DIR__ . '/admin.php';
