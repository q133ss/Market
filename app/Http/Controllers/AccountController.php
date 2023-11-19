<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Question;
use App\Models\Review;
use App\Models\User;
use App\Models\WaitList;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        if($user->role->tech_name == 'admin') {
            $sellers = User::where('role_id', function ($query) {
                return $query->select('id')
                    ->from('roles')
                    ->where('tech_name', 'seller')
                    ->first();
            })->get();

            $reviews = Review::where('approved', 0)->orderBy('created_at', 'DESC')->get();

            $banners = Banner::orderBy('id', 'DESC')->get();

            return view('profile.' . Auth()->user()->role->tech_name . '.index', compact('sellers', 'reviews', 'banners'));
        }elseif($user->role->tech_name == 'seller'){
            $products = $user->products();
            $categories = Category::where('parent_id', '!=', null)->get();
            $cities = City::get();
            $questions = Question::whereIn('product_id',Product::where('shop_id', $user->shop->id)->pluck('id')->all())->get();
            $user = $user->load('shop');
            $reviews = Review::where('reviewable_type', 'App\Models\Product')->whereIn('reviewable_id', Product::where('shop_id', $user->shop->id)->pluck('id')->all())->get();

            return view('profile.' . Auth()->user()->role->tech_name . '.index', compact('products', 'categories', 'cities', 'questions', 'user', 'reviews'));
        }else{
            return view('profile.' . Auth()->user()->role->tech_name . '.index');
        }
    }
}
