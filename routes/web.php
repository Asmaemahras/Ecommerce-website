<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\StripeCheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/ShoppingCart', [ShoppingCartController::class, '__invoke'])
    ->name('cart.index');

Route::get('/checkout', [StripeCheckoutController::class, 'create'])
    ->name('checkout.create');
Route::post('/paymentIntent', [StripeCheckoutController::class, 'paymentIntent'])
   ->name('checkout.paymentIntent');

Route::post('/saveOrder', OrderController::class)
    ->name('orders.save');

require __DIR__.'/auth.php';

Route::get('produits', [ProductController::class , 'index'])
    ->name('products.index');

