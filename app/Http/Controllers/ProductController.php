<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(int $id)
    {
        $product = Product::with('shop', 'photos', 'reviews')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
