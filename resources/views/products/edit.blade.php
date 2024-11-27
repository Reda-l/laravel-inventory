<h1>Edit Product</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- This method is used for updating the resource -->

    <div>
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
    </div>

    <div>
        <label for="sku">SKU:</label>
        <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}">
    </div>

    <div>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
    </div>

    <div>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}">
    </div>

    <button type="submit">Update Product</button>
</form>

<a href="{{ route('products.index') }}">Back to Product List</a>
