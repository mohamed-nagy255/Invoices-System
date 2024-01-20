<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CustemorReportController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoicesReportController;
use App\Http\Controllers\InvoiceAttachmentController;

Route::middleware(['auth', 'verified'])->group(function () {

    //Dashboard
    // Route::get('/', function () { 
    //     return view('dashboard'); 
    // }) -> name('dashboard');
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

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
        Route::get('/export_excel', 'export')->name('export.excel');
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

    //Invoice Reports
    Route::controller(InvoicesReportController::class)->group(function () {
        Route::get('/reports/invoices_report', 'index')->name('report.index');
        Route::post('/reports/invoices_report/search', 'search')->name('report.search');
    });

    //Custemor Reports
    Route::controller(CustemorReportController::class)->group(function () {
        Route::get('/reports/custemor_report', 'index')->name('custemorReport.index');
        Route::post('/reports/custemor_report/search', 'search')->name('custemorReport.search');
    });

    // Users
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('user.index');
        Route::get('/users/create', 'create')->name('user.create');
        Route::post('/users/store', 'store')->name('user.store');
        Route::get('/users/show/{id}', 'show')->name('user.show');
        Route::get('/users/edit/{id}', 'edit')->name('user.edit');
        Route::patch('/users/update/{id}', 'update')->name('user.update');
        Route::delete('/users/destroy', 'destroy')->name('user.destroy');
    });

    // Roles
    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->name('role.index');
        Route::get('/roles/create', 'create')->name('role.create');
        Route::post('/roles/store', 'store')->name('role.store');
        Route::get('/roles/show/{id}', 'show')->name('role.show');
        Route::get('/roles/show/edit/{id}', 'edit')->name('role.edit');
        Route::patch('/roles/show/update/{id}', 'update')->name('role.update');
        Route::delete('/roles/show/destroy/{id}', 'destroy')->name('role.destroy');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
