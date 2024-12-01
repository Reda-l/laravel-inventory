<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'sku',
        'price',
        'quantity'
    ];

    /**
     * Get the sales associated with the product.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public static function topSoldProducts($limit = 5)
{
    return Product::select('products.*')
        ->join('sales', 'products.id', '=', 'sales.product_id')
        ->selectRaw('SUM(sales.quantity) as total_sales') // Ensure we use total_sales here
        ->groupBy('products.id')
        ->orderByDesc('total_sales')
        ->take($limit)
        ->get();
}
}
