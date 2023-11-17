<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /*
     * cart || favorite
     */
    public function addTo(Request $request, int $id, $type = 'cart')
    {
        Product::findOrFail($id);
        $request->session()->push($type, $id);

        return Response('true', 200);
    }

    private function getProducts(Request $request, $type)
    {
        if($request->session()->get($type) != null) {
            if($type == 'shop'){
                return Shop::whereIn('id', $request->session()->get($type))->get();
            }else {
                return Product::whereIn('id', $request->session()->get($type))->get();
            }
        }else{
            return [];
        }
    }

    public function favoriteShop(Request $request)
    {
        $shops = $this->getProducts($request,'shop');
        return view('shop.favorite', compact('shops'));
    }

    public function favorite(Request $request)
    {
        $products = $this->getProducts($request,'favorite');
        return view('favorite', compact('products'));
    }
}
