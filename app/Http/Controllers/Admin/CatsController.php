<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CatsController extends Controller
{

    public function update(Request $request, int $id)
    {
        Category::findOrFail($id)->update(['name' => $request->name]);

        return back()->withSuccess('Категория успешно обновлена');
    }

    public function delete($id)
    {

        $cat = Category::findOrFail($id);
        Category::where('parent_id', $id)->delete();
        $cat->delete();
        return back()->withSuccess('Категория успешно удалена');
    }
}
