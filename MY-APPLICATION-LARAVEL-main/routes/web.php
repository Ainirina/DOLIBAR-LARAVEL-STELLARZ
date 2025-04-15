<?php

use App\Http\Controllers\Admin\CategoryCrudController;
use App\Http\Controllers\Admin\ProductCrudController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\OrderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
use App\Http\Controllers\DolibarrProductController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', ProductCrudController::class);
    Route::resource('categories', CategoryCrudController::class);

});


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/home', [ProductController::class, 'index'])->name('home');
    Route::post('/home/update-Note', [ProductController::class, 'updateNote']);

    Route::post('/like', [LikeController::class, 'like'])->name('like.update');
    Route::get('/like', [LikeController::class, 'showLikedProduct'])->name('like.show');

    Route::post('/cart', [CartController::class, 'cart'])->name('cart.update');
    Route::get('/cart', [CartController::class, 'showMyCart'])->name('cart.show');
    Route::post('/cart/order', [CartController::class, 'order'])->name('cart.order');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');

    Route::get('/orders', [OrderController::class, 'getAllOrderByIdSocid'])->name('orders.index');
    Route::post('/orders/create', [OrderController::class, 'createFacture'])->name('orders.create_facture');

    Route::get('/factures', [FactureController::class, 'getFacture'])->name('factures.index');
    Route::post('/factures/show', [FactureController::class, 'getFacturebyId'])->name('factures.show');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/doli', [DolibarrProductController::class, 'index'])->name('doli.index');

    // Récupérer un produit spécifique par ID
    Route::get('/doli/{id}', [DolibarrProductController::class, 'show'])->name('doli.show');

    // Créer un nouveau produit
    Route::post('/doli', [DolibarrProductController::class, 'store'])->name('doli.store');

    // Mettre à jour la note d'un produit
    Route::put('/doli/update-note', [DolibarrProductController::class, 'updateNote'])->name('doli.updateNote');

    // Supprimer un produit
    Route::delete('/doli/{id}', [DolibarrProductController::class, 'destroy'])->name('doli.destroy');
});

require __DIR__.'/auth.php';
