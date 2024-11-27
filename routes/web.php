<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('products', ProductController::class);

// Display all products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Display a single product
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Show the form to edit a product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Save the updated product
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
