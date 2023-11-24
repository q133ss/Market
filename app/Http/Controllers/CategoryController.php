<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function products(Request $request, int $id)
    {
        //$category = Category::with('products')->findOrFail($id);

        $category = Category::findOrFail($id);
        $products = Product::withFilter($request, null, $id)->where('category_id', $id)->get();

        $cities = City::get();
        $sizes = ProductSize::whereIn('product_id', $products->pluck('id')->all())->get()->unique('size');
        $getColors = $products->pluck('color')->filter()->all();
        $colors = array_diff($getColors, array_diff_assoc($getColors, array_unique($getColors)));

        return view('category.products', compact('products', 'category', 'cities', 'sizes', 'colors'));
    }


}
