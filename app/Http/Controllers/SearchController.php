<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\SearchHistory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, string $search)
    {
        SearchHistory::create([
            'user_id' => Auth()->id(),
            'query' => $search
        ]);

        $categories = Category::get();
        $cities = City::get();


        $products = Product::withFilter($request)->where('name', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%')->orWhere('price', 'LIKE', '%'.$search.'%')->get();

        $colors = $products->pluck('color')->all();

        return view('search', compact('products', 'categories', 'cities', 'colors'));
    }
}
