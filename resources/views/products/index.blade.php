<h1>Products List</h1>
<a href="{{ route('products.create') }}">Add New Product</a>
<ul>
  @foreach($products as $product)
    <li>
      <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
      - <a href="{{ route('products.edit', $product) }}">Edit</a>
       <!-- Delete form -->
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
    </li>
  @endforeach
</ul>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif