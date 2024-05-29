<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PedidoController;
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

Route::get('/',[ShopController::class, 'index'])->name('app.index');
Route::get('/tienda',[TiendaController::class, 'index'])->name('shop.index');
Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/mi-cuenta', [UsuarioController::class, 'index'])->name('user.index');
});

Route::middleware('auth', 'auth.admin')->group(function(){
    Route::get('/administrador', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware('auth')->group(function(){
    Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [PasswordController::class, 'changePassword'])->name('password.update');
});

Route::resource('categories', CategoryController::class);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::get('/dashboard', [ProductController::class, 'index']);  
Route::get('/shopping-cart', [ProductController::class, 'productCart'])->name('shopping.cart');
Route::get('/product/{id}', [ProductController::class, 'addProducttoCart'])->name('addProduct.to.cart');
Route::patch('/update-shopping-cart', [ProductController::class, 'updateCart'])->name('update.shopping.cart');
Route::delete('/delete-cart-product', [ProductController::class, 'deleteProduct'])->name('delete.cart.product');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/cart', [ShopController::class, 'cart'])->name('shopping.cart');
Route::post('/add-to-cart', [ShopController::class, 'addToCart'])->name('addProduct.to.cart');
Route::patch('/remove-from-cart', [ShopController::class, 'removeFromCart'])->name('delete.cart.product');
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/confirmation', [CheckoutController::class, 'showConfirmation'])->name('confirmation');
Route::middleware('auth')->group(function () {
    Route::post('/add-to-favorites', [ShopController::class, 'addToFavorites'])->name('addProduct.to.favorites');
});
Route::get('/pedido/{id}', [PedidoController::class, 'show'])->name('pedido');

Route::get("locale/(lange)", [LocalizationController::class,'setLang']);