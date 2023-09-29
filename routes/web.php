<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;

Route::middleware(['auth', 'verified'])->group(function () {

    //Dashboard
    Route::get('/', function () { return view('dashboard'); }) -> name('dashboard');

    //Sections
    Route::controller(SectionController::class)->group(function () {
        Route::get('/setting/section', 'index') -> name('section.index');
        Route::post('/setting/section/insert', 'store') -> name('section.store');
        Route::post('/setting/section/update', 'update') -> name('section.update');
        Route::post('/setting/section/destroy', 'destroy') -> name('section.destroy');
    });

    //Products
    Route::controller(ProductController::class)->group(function () {
        Route::get('/setting/Product', 'index') -> name('product.index');
        Route::post('/setting/Product/insert', 'store') -> name('product.store');
        Route::post('/setting/Product/update', 'update') -> name('product.update');
        Route::post('/setting/Product/destroy', 'destroy') -> name('product.destroy');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
