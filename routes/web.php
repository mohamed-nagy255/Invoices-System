<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {

    //Dashboard
    Route::get('/', function () { return view('dashboard'); }) -> name('dashboard');

    //Sections
    Route::controller(SectionController::class)->group(function () {
        Route::get('/section/table', 'index') -> name('section.index');
        Route::post('/section/table/insert', 'store') -> name('section.store');
        Route::post('/section/table/update', 'update') -> name('section.update');
        Route::post('/section/table/destroy', 'destroy') -> name('section.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
