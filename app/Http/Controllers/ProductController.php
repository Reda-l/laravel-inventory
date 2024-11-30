<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products|max:100',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        // Only allow these fields to be passed to the create method
        Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        // Redirect back to products list with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function list()
    {
        $products = Product::all();
        return view('dashboard', compact('products'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Generate the QR code (you can encode any URL or data, here we encode the product URL)
        $qrCode = QrCode::size(200)->format('svg')->generate(route('products.show', $product->id));

        return view('products.show', compact('product', 'qrCode'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);  // Get the product by ID
        return view('products.edit', compact('product'));  // Return the edit view with the product data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $id . '|max:100',  // Exclude current SKU from the unique validation
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);  // Find the product by ID
        $product->update($request->all());  // Update the product with the new data

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);  // Find the product by ID
        $product->delete();  // Delete the product

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
