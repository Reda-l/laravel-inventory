<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;  // Make sure to include the Product model

Route::get('/', function () {
    return view('welcome');
});

// Apply the 'auth' middleware to protect these routes
Route::middleware('auth')->group(function () {
    // Product management routes
    Route::resource('products', ProductController::class);

    // Display all products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Display a single product
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Show the form to edit a product
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

    // Save the updated product
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    // Delete a product
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // fetch all products
    Route::get('/products/list', [ProductController::class, 'list'])->name('products.list');

    // pay product
    Route::post('/process-payment/{product}', [ProductController::class, 'processPayment'])->name('process.payment');



    // Dashboard Route (Fetch Top Products and All Products)
    Route::get('/dashboard', function () {
        $topProducts = Product::topSoldProducts(); // Fetch top-selling products
        $products = Product::all(); // Fetch all products from the database
        return view('dashboard', compact('topProducts', 'products')); // Pass both sets of products to the view
    })->middleware(['auth', 'verified'])->name('dashboard');
});

// Auth routes for login, registration, etc.
require __DIR__ . '/auth.php';
