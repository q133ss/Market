<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
 * TODO
 * Закончить деталку товара +
 * В ДЕТАЛКЕ ДОДЕЛАТЬ ПОДПИСКУ НА ТОВАР!!! КОТОРЫЙ НЕ В НАЛИЧИИ
 * Сделать поиск
 * ЛК
 * избранное +
 * Товары магазина страница +-
 */

/*
 * ВОПРОСЫ
 * При добавлении отзыва нет рейтинга
 * Как добавить магазин в избранное? (вывел кнопку)
 *
 *
 * У админа в ЛК есть "отзывы магазинов", что это?
 */


/*
1. Не создается карточка товара (Все ок)
2. Не удаляются фото из карточки. Нужно, чтобы была возможность добавлять несколько фото и видео и удалять по одной картинке. +
3. Сделать кнопку "Поднять наверх"+
4. Возможность добавлять города через акк админа +
5. В кабинет продавца не редактируются карточки. +
6. Фильтры не поправил, странно работают. + Нужно их вывести на страницу товаров при переходе из каталога. +
 */

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::get('/logout', function (){
    Auth()->logout();
    return to_route('login');
})->name('logout');

Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'sendMail']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'auth'])->name('auth');
Route::get('/shop/register', [App\Http\Controllers\AuthController::class, 'shop'])->name('shop.register');
Route::post('/shop/register', [App\Http\Controllers\AuthController::class, 'shopStore'])->name('shop.register.store');

Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::post('/send/review', [App\Http\Controllers\ProductController::class, 'createReview'])->name('products.review.store');
Route::post('/send/question', [App\Http\Controllers\ProductController::class, 'createQuestion'])->name('products.question.store');
Route::get('/shop/{id}/products', [App\Http\Controllers\ShopController::class, 'products'])->name('shop.products'); //Товары магазина
Route::get('/category/{id}', [App\Http\Controllers\CategoryController::class, 'products'])->name('category.show'); //Товары категории
Route::post('/buy/{id}', [App\Http\Controllers\ProductController::class, 'buy']);

Route::post('add-to/{id}/{type}', [App\Http\Controllers\CartController::class, 'addTo']);
Route::get('favorite', [App\Http\Controllers\CartController::class, 'favorite'])->name('favorite');
Route::get('favorite/shops', [App\Http\Controllers\CartController::class, 'favoriteShop'])->name('favorite.shop');

Route::get('/search/{query}', [App\Http\Controllers\SearchController::class, 'search'])->name('search');

Route::middleware('auth')->group(function(){
    Route::prefix('account')->group(function(){
        Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('account');

        Route::middleware('is.admin')->name('admin.')->group(function(){
            Route::get('/user/{id}/status/change/{status}', [App\Http\Controllers\Admin\UsersController::class, 'status'])->name('status.change');
            Route::post('/user/update/{id}', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('user.update');
            Route::get('/review/{id}/{action}', [App\Http\Controllers\Admin\ReviewController::class, 'action'])->name('review.action');
            Route::post('/users', [App\Http\Controllers\Admin\UsersController::class, 'store'])->name('user.store');

            Route::post('/users/{id}/rating', [App\Http\Controllers\Admin\UsersController::class, 'rating'])->name('users.rating');

            Route::post('/banners/{id}', [App\Http\Controllers\Admin\BannerController::class, 'update'])->name('banners.update');
            Route::post('/banners', [App\Http\Controllers\Admin\BannerController::class, 'store'])->name('banners.store');

            Route::post('/city/{id}', [App\Http\Controllers\Admin\CityController::class, 'update'])->name('city.update');
            Route::post('/city/', [App\Http\Controllers\Admin\CityController::class, 'store'])->name('city.store');
        });

        Route::prefix('seller')->middleware('is.seller')->name('seller.')->group(function(){
            Route::post('/product', [App\Http\Controllers\Seller\ProductController::class, 'store'])->name('product.store');
            Route::post('/product/{id}', [App\Http\Controllers\Seller\ProductController::class, 'update'])->name('product.update');
            Route::get('/product/delete/{id}', [App\Http\Controllers\Seller\ProductController::class, 'delete'])->name('product.delete');
            Route::post('/product/{id}/add/size', [App\Http\Controllers\Seller\ProductController::class, 'addSize'])->name('product.add.size');
            Route::post('/product/{id}/add/char', [App\Http\Controllers\Seller\ProductController::class, 'addChar'])->name('product.add.char');
            Route::post('/product/size/{id}/delete', [App\Http\Controllers\Seller\ProductController::class, 'deleteSize']);
            Route::post('/product/char/{id}/delete', [App\Http\Controllers\Seller\ProductController::class, 'deleteChar']);
            Route::post('/delete/file/{id}', [App\Http\Controllers\Seller\ProductController::class, 'deleteFile']);

            Route::post('/shop/update', [App\Http\Controllers\Seller\ProductController::class, 'shopUpdate'])->name('shop.update');

            Route::post('/question/{id}', [App\Http\Controllers\Seller\QuestionController::class, 'update'])->name('quest.update');
        });

        Route::name('cust.')->group(function(){
            Route::post('/cust/update', [App\Http\Controllers\Cust\UpdateController::class, 'update'])->name('update');
        });

    });
});
