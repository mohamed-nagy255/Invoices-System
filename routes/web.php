<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoiceAttachmentController;

Route::middleware(['auth', 'verified'])->group(function () {

    //Dashboard
    Route::get('/', function () { 
        return view('dashboard'); 
    }) -> name('dashboard');

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

    //Invoice
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice/invoice_table/{id_page}', 'index') -> name('invoice.index');
        Route::get('/section/{id}', 'getproducts');
        Route::get('/invoice/invoice_insert', 'insert') -> name('invoice.insert');
        Route::post('/invoice/invoice_store', 'store') -> name('invoice.store');
        Route::get('/invoice/invoice_edit/{id}', 'edit') -> name('invoice.edit');
        Route::post('/invoice/invoice_update', 'update') -> name('invoice.update');
        Route::delete('/invoice/invoice_destroy', 'destroy') -> name('invoice.destroy');
        Route::get('/invoice/invoice_payment/{id}', 'show') -> name('invoice.show.payment');
        Route::post('/invoice/update_payment', 'status_update') -> name('update.payment');
        Route::get('/invoice/invoice_template/{id}', 'invoice_template')->name('invoice.template');
    });

    //Invoice Details
    Route::controller(InvoiceDetailsController::class)->group(function () {
        Route::get('/invoice_details/{id}', 'index') -> name('details.index');
        Route::post('/invoice_details/delete_file', 'destroy') -> name('details.destroy');
        Route::get('/view_file/{invoice_number}/{file_name}', 'open_file') -> name('details.openfile');
        Route::get('/download_file/{invoice_number}/{file_name}', 'get_file') -> name('details.download');
    });

    //Invoice Attachments
    Route::controller(InvoiceAttachmentController::class)->group(function () {
        Route::post('invoice_details/insert_attachment', 'store')->name('attachment.store');
    });

    //Invoice Archive
    Route::controller(InvoiceArchiveController::class)->group(function () {
        Route::get('/invoice/invoice_archive', 'show')->name('invoice.archive');
        Route::get('/invoice/archive_recovery/{id}', 'recovery')->name('recovery.archive');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
