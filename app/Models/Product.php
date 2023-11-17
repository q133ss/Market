<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getForMain()
    {
        return $this->leftJoin('shops', 'shops.id', 'products.shop_id')
            ->leftJoin('users', 'users.id', 'shops.user_id')
            ->leftJoin('files', 'files.fileable_id', 'products.id')
            ->where('files.fileable_type', 'App\Models\Product')
            ->where('files.category', 'product')
            ->orderBy('users.rating', 'DESC')->select('products.*', 'files.src')->get();
    }

    public function shop()
    {
        return $this->hasOne(Shop::class, 'id', 'shop_id');
    }

    public function photos()
    {
        return $this->morphMany(File::class, 'fileable')->where('category', 'product');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable')->where('approved', true);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'product_id', 'id');
    }
}
