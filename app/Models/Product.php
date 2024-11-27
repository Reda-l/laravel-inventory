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
}
