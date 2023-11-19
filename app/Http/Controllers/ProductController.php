<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Product;
use App\Models\Question;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request, int $id)
    {
        if (!is_array($request->session()->get('last_seen'))) {
            $request->session()->put('last_seen', []);
        }
        $request->session()->push('last_seen', $id);
        $product = Product::with('shop', 'photos', 'reviews', 'questions', 'chars', 'sizes')->findOrFail($id);

        $product->update(['views' => $product->views + 1]);

        $lastSeenProducts = Product::with('photos')->whereIn('id', $request->session()->get('last_seen'))->get();
        return view('products.show', compact('product', 'lastSeenProducts'));
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

    public function createQuestion(Request $request)
    {
        $question = Question::create([
            'product_id' => $request->product_id,
            'question' => $request->question,
            'user_id' => Auth()->id()
        ]);

        return $question;
    }

    public function buy($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['buys' => $product->buys + 1]);
        return Response('true');
    }
}
