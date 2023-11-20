<?php

namespace App\Http\Controllers\Cust;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function update(Request $request)
    {
        Auth()->user()->update(['name' => $request->name, 'email' => $request->email]);
        return back()->withSuccess('Профиль успешно обновлен!');
    }
}
