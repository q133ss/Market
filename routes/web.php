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
 */

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'sendMail']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'auth'])->name('auth');

Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::post('/send/review', [App\Http\Controllers\ProductController::class, 'createReview'])->name('products.review.store');
Route::post('/send/question', [App\Http\Controllers\ProductController::class, 'createQuestion'])->name('products.question.store');
Route::get('/shop/{id}/products', [App\Http\Controllers\ShopController::class, 'products'])->name('shop.products'); //Товары магазина
Route::get('/category/{id}', [App\Http\Controllers\CategoryController::class, 'products'])->name('category.show'); //Товары категории

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

            Route::post('/users/{id}/rating', [App\Http\Controllers\Admin\UsersController::class, 'rating'])->name('users.rating');

            Route::post('/banners/{id}', [App\Http\Controllers\Admin\BannerController::class, 'update'])->name('banners.update');
        });

    });
});
