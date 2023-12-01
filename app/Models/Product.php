<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->groupBy(
                'products.name',
                'products.id',
                'products.category_id',
                'products.shop_id',
                'products.compound',
                'products.color',
                'products.price',
                'products.old_price',
                'products.phone',
                'products.description',
                'products.type',
                'products.shipping',
                'products.views',
                'products.favorites',
                'products.buys',
                'products.wait_list',
                'products.in_stock',
                'products.city_id',
                'products.qty',
                'products.created_at',
                'products.updated_at'
            )
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

    public function scopeWithFilter($query, Request $request, string $search = null, $category_id = null)
    {
        $query
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
            ->when($request->query('sort'), function (Builder $query, $sort){
                if($sort == 1){
                    $query->orderBy('created_at', 'DESC');
                }elseif($sort == 2){
                    $query->orderBy('price', 'ASC');
                }elseif($sort == 3){
                    $query->orderBy('price', 'DESC');
                }elseif($sort == 4){
                    $query
                        ->leftJoin('reviews', 'reviews.reviewable_id', 'products.id')
                        ->select('products.*', DB::raw('SUM(reviews.rating) AS raiting'))
                        ->groupBy(
                        'products.name',
                            'products.id',
                            'products.category_id',
                            'products.shop_id',
                            'products.compound',
                            'products.color',
                            'products.price',
                            'products.old_price',
                            'products.phone',
                            'products.description',
                            'products.type',
                            'products.shipping',
                            'products.views',
                            'products.favorites',
                            'products.buys',
                            'products.wait_list',
                            'products.in_stock',
                            'products.city_id',
                            'products.qty',
                            'products.created_at',
                            'products.updated_at'
                        )
                        ->orderBy('raiting', 'DESC');
                }
            })
            ->when($request->query('type'), function (Builder $query, $type){
                $query->where('type', $type);
            });

            if($search != null) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->orWhere('price', 'LIKE', '%' . $search . '%');
            }

            if($category_id != null){
                $query->where('category_id', $category_id);
            }

            return $query;
    }
}
