<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        if($user->role->tech_name == 'admin') {
            $sellers = User::where('role_id', function ($query){
                return $query->select('id')
                    ->from('roles')
                    ->where('tech_name', 'seller')
                    ->first();
            })->get();
            return view('profile.' . Auth()->user()->role->tech_name . '.index', compact('sellers'));
        }else{
            return view('profile.' . Auth()->user()->role->tech_name . '.index');
        }
    }
}
