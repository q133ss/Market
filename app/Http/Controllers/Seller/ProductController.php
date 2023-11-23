<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\ProductController\StoreRequest;
use App\Models\City;
use App\Models\File;
use App\Models\Product;
use App\Models\ProductChar;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function store(StoreRequest $request)
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
            //'in_stock' => $request->in_stock,
            'city_id' => City::where('name', $request->city)->pluck('id')->first(),
            'shop_id' => Auth()->user()->shop->id,
            'qty' => $request->qty
        ]);

        if($request->char_keys) {
            foreach ($request->char_keys as $key => $value) {
                ProductChar::create([
                    'product_id' => $product->id,
                    'key' => $value,
                    'value' => $request->char_vals[$key]
                ]);
            }
        }

        if($request->sizes) {
            foreach ($request->sizes as $size) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size' => $size
                ]);
            }
        }

        if($request->img) {
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
        }

        return back()->withSuccess('Товар успешно добавлен');
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
            //'in_stock' => $request->in_stock,
            'qty' => $request->qty
        ]);

        if($request->img) {
            //File::where('fileable_id', $id)->where('fileable_type', 'App\Models\Product')->delete();
            foreach ($request->img as $file) {
                $path = $file->store('products', 'public');
                if($file->extension() == 'mp4'){
                    $category = 'video';
                }else {
                    $category = 'product';
                }
                File::create(
                    [
                        'fileable_type' => 'App\Models\Product',
                        'fileable_id' => $id,
                        'category' => $category,
                        'src' => '/storage/' . $path
                    ]
                );
            }
        }

        return back()->withSuccess('Товар успешно обновлен!');
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

    public function shopUpdate(Request $request)
    {
        $shop = Auth()->user()->shop;
        $shop->update([
            'title' => $request->title,
            'phone' => $request->phone,
            'description' => $request->description,
            'communication_info' => $request->communication_info,
            'shipping_info' => $request->shipping_info
        ]);

        if($request->img){
            $path = $request->img->store('shops', 'public');
            File::where('fileable_type', 'App\Models\Shop')->where('fileable_id', $shop->id)->delete();
            File::create([
                'fileable_type' => 'App\Models\Shop',
                'fileable_id' => $shop->id,
                'src' => '/storage/'.$path,
                'category' => 'shop'
            ]);
        }
    }

    public function deleteFile(int $id)
    {
        $file = File::findOrFail($id);
        Storage::disk('public')->delete(str_replace('/storage/', '', $file->src));
        $file->delete();

        return true;
    }
}
