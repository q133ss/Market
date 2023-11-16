<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\City;
use App\Models\File;
use App\Models\Product;
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

                if($key == 'seller'){
                    $shop = Shop::create([
                        'user_id' => $user->id
                    ]);

                    for($i = 1; $i < 10; $i++) {
                        $product = Product::create([
                            'name' => $user->name . ' Товар ' . $i,
                            'shop_id' => $shop->id,
                            'category_id' => $cats[rand(0, 8)],
                            'price' => rand(999, 2019),
                            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci culpa dolor eaque eos esse exercitationem, illum laudantium magni odit officiis praesentium quod reiciendis reprehenderit sit, suscipit temporibus ullam vel vitae.',
                            'city_id' => City::inRandomOrder()->pluck('id')->first(),
                        ]);

                        File::create([
                            'src' => '/assets/images/product.png',
                            'category' => 'product',
                            'fileable_type' => 'App\Models\Product',
                            'fileable_id' => $product->id
                        ]);
                    }
                }
            }
        }
    }
}
