<h1>{{ $product->name }}</h1>
<p>{{ $product->description }}</p>
<p>Price: ${{ $product->price }}</p>

<!-- Display the generated QR code -->
<div>
    <h3>Scan the QR code to view this product:</h3>
    {!! $qrCode !!}</div>

<a href="{{ route('products.index') }}">Back to Products</a>
