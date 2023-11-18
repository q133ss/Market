<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
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
            return view('profile.' . Auth()->user()->role->tech_name . '.index', compact('products', 'categories'));
        }else{
            return view('profile.' . Auth()->user()->role->tech_name . '.index');
        }
    }
}
