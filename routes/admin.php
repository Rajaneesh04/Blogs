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
        Route::get('contactreq',[AdminController::class,'contactReq'])->name('admin.contactreq.index');

        // BLOG ROUTES
        Route::get('create',[AdminController::class,'create'])->name('admin.blogs.create');
        Route::post('store',[AdminController::class,'store'])->name('admin.blogs.store');
        Route::get('edit/{blog}',[AdminController::class,'edit'])->name('admin.blogs.edit');
        Route::post('update/{blog}',[AdminController::class,'update'])->name('admin.blogs.update');
        Route::post('delete/{blog}',[AdminController::class,'destroy'])->name('admin.blogs.delete');
        Route::get('blogs',[AdminController::class,'index'])->name('admin.blogs.index');
        Route::post('logout',[AdminController::class,'logout'])->name('admin.logout');

        // CATEGORY ROUTES
        Route::get('categories',[CategoryController::class,'index'])->name('admin.categories.index');
        Route::get('categories/create',[CategoryController::class,'create'])->name('admin.categories.create');
        Route::post('categories/store',[CategoryController::class,'store'])->name('admin.categories.store');
        Route::get('categories/edit/{category}',[CategoryController::class,'edit'])->name('admin.categories.edit');
        Route::post('categories/update/{category}',[CategoryController::class,'update'])->name('admin.categories.update');
        Route::post('categories/delete/{category}',[CategoryController::class,'destroy'])->name('admin.categories.delete');
    });
    
});
