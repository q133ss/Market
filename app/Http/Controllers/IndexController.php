<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'DESC')->get();
        return view('index', compact('banners'));
    }
}
