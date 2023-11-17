<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function products(int $id)
    {
        $category = Category::with('products')->findOrFail($id);
        return view('category.products', compact('category'));
    }


}
