<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(int $id)
    {
        $product = Product::with('shop', 'photos', 'reviews')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function createReview(Request $request)
    {
        $review = Review::create([
            'user_id' => Auth()->id(),
            'reviewable_type' => 'App\Models\Product',
            'reviewable_id' => $request->id,
            'title' => $request->review
        ]);

        foreach ($request->file_input as $file){
            $path = $file->store('reviews', 'public');
            File::create(
                [
                    'fileable_type' => 'App\Models\Review',
                    'fileable_id' => $review->id,
                    'category' => 'review',
                    'src' => '/storage/'.$path
                ]
            );
        }
    }
}
