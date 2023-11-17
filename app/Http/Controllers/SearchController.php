<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, string $search)
    {
        $products = Product::where('name', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%')->orWhere('price', 'LIKE', '%'.$search.'%')->get();
        return view('search', compact('products'));
    }
}
