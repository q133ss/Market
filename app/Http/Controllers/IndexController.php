<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'DESC')->get();

        $products = (new Product)->getForMain();

        return view('index', compact('banners', 'products'));
    }
}
