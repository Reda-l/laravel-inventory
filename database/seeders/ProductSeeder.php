<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Sample Product 1',
            'sku' => 'PROD001',
            'description' => 'This is a description for Sample Product 1.',
            'quantity' => 100,
            'price' => 49.99,
        ]);

        Product::create([
            'name' => 'Sample Product 2',
            'sku' => 'PROD002',
            'description' => 'This is a description for Sample Product 2.',
            'quantity' => 50,
            'price' => 19.99,
        ]);
    }
}
