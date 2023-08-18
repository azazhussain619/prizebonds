<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/dashboard/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');

    Route::get('/admin/denominations', [\App\Http\Controllers\Admin\DenominationController::class, 'index'])->name('denominations.index');
    Route::get('/admin/denominations/create', [\App\Http\Controllers\Admin\DenominationController::class, 'create'])->name('denominations.create');
    Route::post('/admin/denominations', [\App\Http\Controllers\Admin\DenominationController::class, 'store'])->name('denominations.store');
    Route::get('/admin/denominations/{denomination}/edit', [\App\Http\Controllers\Admin\DenominationController::class, 'edit'])->name('denominations.edit');
    Route::put('/admin/denominations/{denomination}', [\App\Http\Controllers\Admin\DenominationController::class, 'update'])->name('denominations.update');

    Route::get('/admin/prizes', [\App\Http\Controllers\Admin\PrizeController::class, 'index'])->name('prizes.index');
    Route::get('/admin/prizes/create', [\App\Http\Controllers\Admin\PrizeController::class, 'create'])->name('prizes.create');
    Route::post('/admin/prizes', [\App\Http\Controllers\Admin\PrizeController::class, 'store'])->name('prizes.store');
    Route::get('/admin/prizes/{prize}/edit', [\App\Http\Controllers\Admin\PrizeController::class, 'edit'])->name('prizes.edit');
    Route::put('/admin/prizes/{prize}', [\App\Http\Controllers\Admin\PrizeController::class, 'update'])->name('prizes.update');

    Route::get('/admin/draw-results', [\App\Http\Controllers\Admin\DrawResultController::class, 'index'])->name('draw-results.index');
    Route::get('/admin/draw-results/create', [\App\Http\Controllers\Admin\DrawResultController::class, 'create'])->name('draw-results.create');
    Route::post('/admin/draw-results', [\App\Http\Controllers\Admin\DrawResultController::class, 'store'])->name('draw-results.store');
    Route::get('/admin/draw-results/{draw-result}/edit', [\App\Http\Controllers\Admin\DrawResultController::class, 'edit'])->name('draw-results.edit');
    Route::put('/admin/draw-results/{draw-result}', [\App\Http\Controllers\Admin\DrawResultController::class, 'update'])->name('draw-results.update');

    Route::get('/admin/draws', [\App\Http\Controllers\Admin\DrawController::class, 'index'])->name('draws.index');
    Route::get('/admin/draws/create', [\App\Http\Controllers\Admin\DrawController::class, 'create'])->name('draws.create');
    Route::post('/admin/draws', [\App\Http\Controllers\Admin\DrawController::class, 'store'])->name('draws.store');
    Route::get('/admin/draws/{draw}/edit', [\App\Http\Controllers\Admin\DrawController::class, 'edit'])->name('draws.edit');
    Route::put('/admin/draws/{draw}', [\App\Http\Controllers\Admin\DrawController::class, 'update'])->name('draws.update');

    Route::get('/admin/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/admin/categories/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/admin/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/admin/categories/{category}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/admin/categories/{category}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');

    Route::get('/admin/posts', [\App\Http\Controllers\Admin\PostController::class, 'index'])->name('posts.index');
    Route::get('/admin/posts/create', [\App\Http\Controllers\Admin\PostController::class, 'create'])->name('posts.create');
    Route::post('/admin/posts', [\App\Http\Controllers\Admin\PostController::class, 'store'])->name('posts.store');
    Route::get('/admin/posts/{post}/edit', [\App\Http\Controllers\Admin\PostController::class, 'edit'])->name('posts.edit');
    Route::put('/admin/posts/{post}', [\App\Http\Controllers\Admin\PostController::class, 'update'])->name('posts.update');

    Route::get('/admin/posts/draw/create', [\App\Http\Controllers\Admin\PostController::class, 'createDrawPost'])->name('posts.draw.create');
    Route::post('/admin/posts/draw', [\App\Http\Controllers\Admin\PostController::class, 'storeDrawPost'])->name('posts.draw.store');

    Route::get('/admin/create-draw-posts', [\App\Http\Controllers\Admin\PostController::class, 'createDrawPosts']);

});

Route::get('/', [App\Http\Controllers\Blog\HomeController::class, 'index']);
Route::get('/draw-search', [App\Http\Controllers\Blog\DrawController::class, 'index']);
Route::post('/draw-search', [App\Http\Controllers\Blog\DrawController::class, 'search'])->name('draws.search');
Route::get('/category/{category:slug}', [App\Http\Controllers\Blog\CategoryController::class, 'show']);
Route::get('/admin/draws-by-denomination', [\App\Http\Controllers\Admin\DrawController::class, 'getDrawsByDenomination'])->name('draws.by-denomination');
Route::get('/{post:slug}', [App\Http\Controllers\Blog\PostController::class, 'show']);

