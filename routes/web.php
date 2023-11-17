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
 * Закончить деталку товара
 * Сделать поиск
 * ЛК
 * Корзина и избранное
 * Товары магазина страница
 */

/*
 * ВОПРОСЫ
 * При добавлении отзыва нет рейтинга
 */

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'sendMail']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'auth'])->name('auth');

Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::post('/send/review', [App\Http\Controllers\ProductController::class, 'createReview'])->name('products.review.store');
Route::post('/send/question', [App\Http\Controllers\ProductController::class, 'createQuestion'])->name('products.question.store');

Route::middleware('auth')->group(function(){
    Route::prefix('account')->group(function(){
        Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    });
});
