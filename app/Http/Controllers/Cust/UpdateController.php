<?php

namespace App\Http\Controllers\Cust;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function update(Request $request)
    {
        $data = ['name' => $request->name, 'email' => $request->email];

        if($request->has('new_password')){
            if(Hash::check($request->old_password, Auth()->user()->password)){
                $data['password'] = Hash::make($request->new_password);
            }
        }

        Auth()->user()->update($data);
        return back()->withSuccess('Профиль успешно обновлен!');
    }
}
