<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin')->group(function(){

    Route::middleware(['admin.redirect'])->group(function(){
        Route::get('login',[AdminController::class,'login'])->name('admin.login');
        Route::post('login',[AdminController::class,'checkLogin'])->name('admin.login.post');
    });
    
    Route::middleware(['admin.auth'])->group(function(){
        Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
        
        // Blog Routes
        Route::get('blogs',[AdminController::class,'index'])->name('admin.blogs.index');
        Route::get('create',[AdminController::class,'create'])->name('admin.blogs.create');
        Route::post('store',[AdminController::class,'store'])->name('admin.blogs.store');
        Route::get('edit/{blog}',[AdminController::class,'edit'])->name('admin.blogs.edit');
        Route::post('update/{blog}',[AdminController::class,'update'])->name('admin.blogs.update');
        Route::post('delete/{blog}',[AdminController::class,'destroy'])->name('admin.blogs.delete');
        
        // User Management Routes
        Route::get('users',[AdminController::class,'users'])->name('admin.users.index');
        Route::post('users/{user}/toggle-active',[AdminController::class,'toggleUserActive'])->name('admin.users.toggle');
        Route::delete('users/{user}',[AdminController::class,'deleteUser'])->name('admin.users.delete');
        
        // Contact Requests Routes
        Route::get('contact-requests',[AdminController::class,'contactRequests'])->name('admin.contactreq.index');
        Route::delete('contact-requests/{submission}',[AdminController::class,'deleteContactRequest'])->name('admin.contactreq.delete');
        
        // Category Routes
        Route::get('categories',[CategoryController::class,'index'])->name('admin.categories.index');
        Route::get('categories/create',[CategoryController::class,'create'])->name('admin.categories.create');
        Route::post('categories/store',[CategoryController::class,'store'])->name('admin.categories.store');
        Route::get('categories/edit/{category}',[CategoryController::class,'edit'])->name('admin.categories.edit');
        Route::post('categories/update/{category}',[CategoryController::class,'update'])->name('admin.categories.update');
        Route::post('categories/delete/{category}',[CategoryController::class,'destroy'])->name('admin.categories.delete');
        
        // Logout
        Route::post('logout',[AdminController::class,'logout'])->name('admin.logout');
    });
    
});
