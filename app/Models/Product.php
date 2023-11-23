<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getForMain()
    {
        return $this->join('shops', 'shops.id', 'products.shop_id')
            ->join('users', 'users.id', 'shops.user_id')
            ->leftJoin('files', 'files.fileable_id', 'products.id')
            ->select('products.*')
            ->orderBy('users.rating', 'DESC')
            ->get();
    }

    public function shop()
    {
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }

    public function photos()
    {
        return $this->morphMany(File::class, 'fileable')->where('category', 'product')->orWhere('category', 'video');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable')->where('approved', true);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /*
     * Характеристики
     */
    public function chars()
    {
        return $this->hasMany(ProductChar::class, 'product_id', 'id');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'id');
    }

    public function scopeWithFilter($query, Request $request, string $search)
    {
        return $query
            ->when($request->query('category_id'), function (Builder $query, $category) {
                $query->where('category_id', $category);
            })
            ->when($request->query('color'), function (Builder $query, $color){
                $query->where('color', $color);
            })
            ->when($request->query('compound'), function (Builder $query, $compound){
                $query->where('compound', $compound);
            })
            ->when($request->query('price'), function(Builder $query, $price){
                $query->where('price', '<', $price);
            })
            ->when($request->query('city_id'), function (Builder $query, $city){
                $query->where('city_id', $city);
            })
            ->when($request->query('size_id'), function (Builder $query, $size){
                $query->leftJoin('product_sizes', 'product_sizes.product_id', 'products.id')
                    ->where('product_sizes.id', $size);
            })
            ->where('name', 'LIKE', '%'.$search.'%');
    }
}
