<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRoles\RoleController;
use App\Http\Controllers\UserRoles\UserController;
use App\Http\Controllers\VisitorController;
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

/************** Visitor Routes *******************/

Route::get('/', [VisitorController::class, 'index']);
Route::resource('orders', OrdersController::class);
Route::get('product_show{id}', [ProductsController::class,'show'])->name('product_show');
Route::get('invoice_show{id}', [InvoicesController::class,'show'])->name('invoice_show');

Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

/************** Dashboard Routes *******************/



Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductsController::class);
    Route::delete('products',[ProductsController::class,'destroy'])->name('products.destroy');
    Route::resource('categories', CategoriesController::class);
    Route::delete('categories',[CategoriesController::class,'destroy'])->name('categories.destroy');
    Route::resource('customers', CustomersController::class);
    Route::resource('invoices', InvoicesController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /************** UserRoles Routes *******************/

    Route::resource('roles', RoleController::class);
    Route::delete('roles',[RoleController::class,'destroy'])->name('roles.destroy');
    Route::resource('users', UserController::class);
    Route::delete('users',[UserController::class,'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';
