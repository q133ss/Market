<?php
namespace App\Services;

use App\Models\Category;

class InitService{

    /**
     * Возвращает родительские категории для меню
     *
     * @return Category
     */
    public function categories() : \Illuminate\Database\Eloquent\Collection
    {
        return Category::where('parent_id', null)->with('children')->orderBy('created_at', 'DESC')->get();
    }
}
