<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('profile.' . Auth()->user()->role->tech_name . '.index');
    }
}
