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

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'sendMail']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'auth'])->name('auth');

Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function(){
    Route::prefix('account')->group(function(){
        Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
    });
});
