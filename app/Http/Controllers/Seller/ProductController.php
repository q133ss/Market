<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Product;
use App\Models\ProductChar;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'compound' => $request->compound,
            'color' => $request->color,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'phone' => $request->phone,
            'description' => $request->description,
            'shipping' => $request->shipping,
            'in_stock' => $request->in_stock
        ]);

        foreach ($request->img as $file) {
            $path = $file->store('products', 'public');
            File::create(
                [
                    'fileable_type' => 'App\Models\Product',
                    'fileable_id' => $product->id,
                    'category' => 'product',
                    'src' => '/storage/' . $path
                ]
            );
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'compound' => $request->compound,
            'color' => $request->color,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'phone' => $request->phone,
            'description' => $request->description,
            'shipping' => $request->shipping,
            'in_stock' => $request->in_stock
        ]);

        if($request->img) {
            File::where('fileable_id', $id)->where('fileable_type', 'App\Models\Product')->delete();
            foreach ($request->img as $file) {
                $path = $file->store('products', 'public');
                File::create(
                    [
                        'fileable_type' => 'App\Models\Product',
                        'fileable_id' => $id,
                        'category' => 'product',
                        'src' => '/storage/' . $path
                    ]
                );
            }
        }

        return back();
    }

    public function addSize(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($product->shop_id != Auth()->user()->shop->id){
            abort(403);
        }

        if(in_array($request->size, $product->sizes->pluck('size')->all())){
            abort(403);
        }

        $size = ProductSize::create([
            'product_id' => $id,
            'size' => $request->size
        ]);

        return $size;
    }

    public function addChar(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($product->shop_id != Auth()->user()->shop->id){
            abort(403);
        }

        $char = ProductChar::create([
            'product_id' => $id,
            'key' => $request->key,
            'value' => $request->value
        ]);

        return $char;
    }

    public function deleteSize($id)
    {
        $size = ProductSize::findOrFail($id);

        if(!$size->product->shop->user_id == Auth()->id()){
            abort(403);
        }

        $size->delete();

        return true;
    }

    public function deleteChar($id)
    {
        $char = ProductChar::findOrFail($id);

        if(!$char->product->shop->user_id == Auth()->id()){
            abort(403);
        }

        $char->delete();

        return true;
    }
}
