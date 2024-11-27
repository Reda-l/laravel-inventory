<!-- resources/views/products/create.blade.php -->
<h1>Create a New Product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label for="sku">Product SKU:</label>
        <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required>
    </div>

    <div>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="{{ old('price') }}" required>
    </div>

    <div>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" required>
    </div>

    <button type="submit">Create Product</button>
</form>

<a href="{{ route('products.index') }}">Back to Products</a>
