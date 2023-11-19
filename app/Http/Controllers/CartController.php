<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use App\Models\WaitList;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /*
     * cart || favorite
     */
    public function addTo(Request $request, int $id, $type = 'cart')
    {
        $product = Product::findOrFail($id);


        if($request->session()->get('favorite') != null && in_array($id, $request->session()->get('favorite'))) {
            //удаляем
            $products = session('favorite');
            foreach ($products as $key => $value) {
                if ($value == $id) {
                    unset($products[$key]);
                }
            }
            session(['favorite' => $products]);
            $product->update(['favorites' => $product->favorites - 1]);

        }elseif($type == 'wait'){
            $product->update(['wait_list' => $product->wait_list + 1]);
            $request->session()->push($type, $id);
        }else{
            $request->session()->push($type, $id);

            if($type == 'favorite'){
                //check if session not has
                $product->update(['favorites' => $product->favorites+1]);
            }
        }

        return Response('true', 200);
    }

    private function getProducts(Request $request, $type)
    {
        if($request->session()->get($type) != null) {
            if($type == 'shop') {
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
