<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function action(int $id, string $action)
    {
        $review = Review::findOrFail($id);
        if($action == 0){
            $review->delete();
        }else{
            $review->update(['approved' => 1]);
        }

        return back();
    }
}
