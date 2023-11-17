<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function products(int $id)
    {
        $shop = Shop::with('products')->findOrFail($id);
        return view('shop.products', compact('shop'));
    }
}
