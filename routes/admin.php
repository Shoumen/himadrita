<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BackendController\DashboardController;
use App\Http\Controllers\BackendController\CustomerController;
use App\Http\Controllers\BackendController\CategoryController;
use App\Http\Controllers\BackendController\BrandController;
use App\Http\Controllers\BackendController\SupplierController;
use App\Http\Controllers\BackendController\RecycleBinController;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'verified')->group(function () {

    Route::resource('dashboard', DashboardController::class);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
 // --------------------> Customers <--------------------
    Route::resource('customer', CustomerController::class)->except(['show', 'edit', 'create']);
 // --------------------> suppliers <--------------------
    Route::resource('supplier', SupplierController::class)->except(['show', 'edit', 'create']);
 // --------------------> Category <--------------------
    Route::resource('category', CategoryController::class)->except(['show', 'edit', 'create']);
// --------------------> Brand <--------------------
    Route::resource('brand', BrandController::class)->except(['show', 'edit', 'create']);

Route::prefix('recycle-bin')->name('recycle.')->group(function () {
    Route::get('/customer', [RecycleBinController::class, 'customer'])->name('customer');
    Route::get('/supplier', [RecycleBinController::class, 'supplier'])->name('supplier');
    Route::get('/product', [RecycleBinController::class, 'product'])->name('product');
    Route::get('/purchase', [RecycleBinController::class, 'purchase'])->name('purchase');
    Route::get('/transaction', [RecycleBinController::class, 'transaction'])->name('transaction');

    Route::post('/restore/{type}/{id}', [RecycleBinController::class, 'restore'])->name('restore');
    Route::delete('/delete/{type}/{id}', [RecycleBinController::class, 'forceDelete'])->name('delete');
});

Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity.logs');
Route::delete('activity-logs/{id}', [ActivityLogController::class, 'destroy'])->name('activity.logs.destroy');

