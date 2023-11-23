<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\SearchHistory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, string $search)
    {
        if(Auth()->check()) {
            SearchHistory::create([
                'user_id' => Auth()->id(),
                'query' => $search
            ]);
        }

        $categories = Category::get();
        $cities = City::get();
        $sizes = ProductSize::get()->unique('size');

        $products = Product::withFilter($request, $search)->get();
            //->where('name', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%')->orWhere('price', 'LIKE', '%'.$search.'%')->get();

        $getColors = $products->pluck('color')->filter()->all();
        $colors = array_diff($getColors, array_diff_assoc($getColors, array_unique($getColors)));

        return view('search', compact('products', 'categories', 'cities', 'colors', 'sizes'));
    }
}
