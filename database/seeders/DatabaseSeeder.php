<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Banner;
use App\Models\Category;
use App\Models\City;
use App\Models\File;
use App\Models\Product;
use App\Models\Review;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $roles = [
            'admin' => 'Админ',
            'customer' => 'Покупатель',
            'seller' => 'Продавец'
        ];

        foreach ($roles as $key => $role){
            \App\Models\Role::create(['tech_name' => $key, 'name' => $role]);
        }

        \App\Models\User::create([
            'email' => 'admin@email.net',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        $categories = [
            [
                'name' => 'Посуда',
            ],
            [
                'name' => 'Тарелки',
                'parent_id' => 1
            ],
            [
                'name' => 'Бокалы и стаканы',
                'parent_id' => 1
            ],
            [
                'name' => 'Столовые приборы',
                'parent_id' => 1
            ],
            [
                'name' => 'Ковры'
            ],
            [
                'name' => 'Современные',
                'parent_id' => 5
            ],
            [
                'name' => 'Шегги',
                'parent_id' => 5
            ],
            [
                'name' => 'Классические',
                'parent_id' => 5
            ],
            [
                'name' => 'Детские',
                'parent_id' => 5
            ],
            [
                'name' => 'Восточные',
                'parent_id' => 5
            ],
            [
                'name' => 'Хозтовары'
            ],
            [
                'name' => 'Бытовая химия',
                'parent_id' => 11
            ],
            [
                'name' => 'Мусорные баки',
                'parent_id' => 11
            ],
            [
                'name' => 'Гладильные доски',
                'parent_id' => 11
            ],
            [
                'name' => 'Личная гигиена',
                'parent_id' => 11
            ],
        ];

        foreach($categories as $category){
            Category::create($category);
        }

        $cats = [2,3,4,6,7,8,12,13,14];

        $cities = [
            'Москва',
            'Воронеж',
            'Санкт петербург',
            'Казань',
            'Сочи'
        ];

        foreach ($cities as $city){
            City::create(['name' => $city]);
        }

        foreach ($roles as $key => $role){
            for($i = 0; $i < 3; $i++){
                $user = User::create([
                    'name' => $key.' '.$i,
                    'email' => $role . $i .  '@email.net',
                    'password' => Hash::make('password'),
                    'role_id' => \App\Models\Role::where('tech_name', $key)->pluck('id')->first(),
                    'status' => rand(0,1)
                ]);

//                if($key == 'seller'){
//                    $shop = Shop::create([
//                        'user_id' => $user->id
//                    ]);
//
//                    for($i = 1; $i < 10; $i++) {
//                        $product = Product::create([
//                            'name' => $user->name . ' Товар ' . $i,
//                            'shop_id' => $shop->id,
//                            'category_id' => $cats[rand(0, 8)],
//                            'price' => rand(999, 2019),
//                            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci culpa dolor eaque eos esse exercitationem, illum laudantium magni odit officiis praesentium quod reiciendis reprehenderit sit, suscipit temporibus ullam vel vitae.',
//                            'city_id' => City::inRandomOrder()->pluck('id')->first(),
//                        ]);
//
//                        File::create([
//                            'src' => '/assets/images/product.png',
//                            'category' => 'product',
//                            'fileable_type' => 'App\Models\Product',
//                            'fileable_id' => $product->id
//                        ]);
//                    }
//                }
            }
        }

        for ($i = 0; $i < 3; $i++){
            $banner = Banner::create([
                'link' => 'google.com',
                'title' => 'Хочешь одеваться стильно, тогда тебе к нам!',
                'text' => 'Лучшая одежда по лучшим ценам'
            ]);

            File::create([
                'src' => '/assets/images/slide.png',
                'category' => 'banner',
                'fileable_type' => 'App\Models\Banner',
                'fileable_id' => $banner->id
            ]);
        }

        $sellers = [
            [
                'name' => 'Продавец с рейтингом +2',
                'email' => 'new_seller2@email.net',
                'password' => Hash::make('password'),
                'status' => 1,
                'rating' => 2,
                'role_id' => 3
            ],
            [
                'name' => 'Продавец с рейтингом +1',
                'email' => 'new_seller1@email.net',
                'password' => Hash::make('password'),
                'status' => 1,
                'rating' => 1,
                'role_id' => 3
            ],
            [
                'name' => 'Продавец с рейтингом 0',
                'email' => 'new_seller0@email.net',
                'password' => Hash::make('password'),
                'status' => 1,
                'rating' => 0,
                'role_id' => 3
            ],
            [
                'name' => 'Продавец с рейтингом -1',
                'email' => 'new_seller-1@email.net',
                'password' => Hash::make('password'),
                'status' => 1,
                'rating' => -1,
                'role_id' => 3
            ]
        ];

        $reviewTitles = [
            'Хороший товар',
            'Рекомендую!',
            'Отличное качество!',
            'Плохое качество',
            'Все хорошо',
            'Не соответсвует описанию',
            'Хороший материал',
            'Все пришло быстро и отлично упаковано',
            'все нормально',
            'Доставка быстрая!'
        ];

        for($i = 0; $i<10; $i++){
            User::create([
                'name' => 'Покупатель '.$i,
                'email' => 'cust'.$i.'email.net',
                'role_id' => 2,
                'password' => '---'
            ]);
        }

        foreach ($sellers as $seller){
            $user = User::create($seller);
            $shop = Shop::create([
                'title' => 'Магазин продавца '.$user->id,
                'user_id' => $user->id
            ]);

            for ($i = 0; $i < rand(3,5); $i++){
                $price = rand(999, 10999);
                $product = Product::create([
                    'name' => 'Рейтинг продавца '.$user->rating,
                    'category_id' => rand(6,9),
                    'price' => $price,
                    'old_price' => null,
                    'description' => 'Описание товара',
                    'in_stock' => 1,
                    'shop_id' => $shop->id,
                    'city_id' => City::inRandomOrder()->pluck('id')->first()
                ]);
                File::create([
                    'src' => '/assets/images/product.png',
                    'category' => 'product',
                    'fileable_type' => 'App\Models\Product',
                    'fileable_id' => $product->id
                ]);
            }
        }

        foreach(Product::get() as $product){

            for($r = 0; $r < rand(5,10); $r++){
                $review = Review::create([
                    'user_id' => User::where('role_id', 2)->inRandomOrder()->pluck('id')->first(),
                    'reviewable_id' => $product->id,
                    'reviewable_type' => 'App\Models\Product',
                    'title' => $reviewTitles[rand(0,9)],
                    'rating' => rand(1,5),
                    'approved' => true
                ]);
            }
        }

        foreach (Review::get() as $review) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                File::create([
                    'src' => '/assets/images/product.png',
                    'fileable_type' => 'App\Models\Review',
                    'fileable_id' => $review->id,
                    'category' => 'review'
                ]);
            }
        }
    }
}
