<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <!-- Top Products -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-gray-900">Top Products</h1>
                    <p class="mt-2 text-sm text-gray-700">Products with the highest sales in your store.</p>
                </div>
            </div>
    
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">
                                        Product Name
                                    </th>
                                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total Sales</th>
                                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($topProducts as $product)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                            {{ $product->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $product->total_sales }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            ${{ number_format($product->price, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-12">
        <!-- Products Table -->
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-gray-900">Products</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the products in your store, including their name,
                        description, price, and actions.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <!-- Trigger Button -->
                    <button
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-indigo-500 focus:outline-none"
                        onclick="openModal()">
                        Create Product
                    </button>
                </div>
            </div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">
                                        Product Name</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                            <a href="{{ route('products.show', $product->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                {{ $product->name }}
                                            </a>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $product->description }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            ${{ number_format($product->price, 2) }}</td>
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:pr-8">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="createProductModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-gray-900">Create Product</h2>
                                <button class="text-gray-400 hover:text-gray-600 focus:outline-none"
                                    onclick="closeModal()">
                                    ✖
                                </button>
                            </div>

                            <form id="createProductForm">
                                @csrf
                                <div class="mt-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Product
                                        Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mt-4">
                                    <label for="sku" class="block text-sm font-medium text-gray-700">Product
                                        SKU</label>
                                    <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mt-4">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>{{ old('description') }}</textarea>
                                </div>

                                <div class="mt-4">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mt-4">
                                    <label for="quantity"
                                        class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <button type="button"
                                        class="mr-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none"
                                        onclick="closeModal()">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-indigo-500 focus:outline-none">
                                        Create Product
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function openModal() {
                    document.getElementById('createProductModal').classList.remove('hidden');
                }

                function closeModal() {
                    document.getElementById('createProductModal').classList.add('hidden');
                }

                // Handle Form Submission
                async function refreshProductList() {
                    const response = await fetch('{{ route('products.list') }}');
                    if (response.ok) {
                        const products = await response.json();
                        renderProductTable(products);
                    } else {
                        console.error('Failed to refresh products list');
                    }
                }

                function renderProductTable(products) {
                    const tbody = document.querySelector('tbody');
                    tbody.innerHTML = ''; // Clear existing rows
                    products.forEach(product => {
                        const row = `
            <tr>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">${product.name}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${product.sku}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${product.price}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${product.quantity}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${product.description}</td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:pr-8">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                </td>
            </tr>
        `;
                        tbody.insertAdjacentHTML('beforeend', row);
                    });
                }

                // Call refreshProductList after creating a new product
                document.getElementById('createProductForm').addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const response = await fetch('{{ route('products.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: formData,
                    });

                    if (response.ok) {
                        closeModal();
                        alert('Product created successfully!');
                        await refreshProductList(); // Refresh the product list
                    } else {
                        const errors = await response.json();
                        console.error(errors);
                        alert('Failed to create product. Check the console for details.');
                    }
                });
            </script>
        </div>
    </div>
</x-app-layout>
