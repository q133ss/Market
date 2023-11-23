<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function update(int $id, Request $request)
    {
        City::findOrFail($id)->update(['name' => $request->name]);
        return back()->withSuccess('Город успешно обновлен');
    }

    public function store(Request $request)
    {
        City::create(['name' => $request->name]);
        return back()->withSuccess('Город успешно добавлен');
    }
}
