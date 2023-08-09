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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/admin/denominations', [App\Http\Controllers\DenominationController::class, 'index'])->name('denominations.index');
    Route::get('/admin/denominations/create', [App\Http\Controllers\DenominationController::class, 'create'])->name('denominations.create');
    Route::post('/admin/denominations', [App\Http\Controllers\DenominationController::class, 'store'])->name('denominations.store');
    Route::get('/admin/denominations/{denomination}/edit', [App\Http\Controllers\DenominationController::class, 'edit'])->name('denominations.edit');
    Route::put('/admin/denominations/{denomination}', [App\Http\Controllers\DenominationController::class, 'update'])->name('denominations.update');

    Route::get('/admin/prizes', [App\Http\Controllers\PrizeController::class, 'index'])->name('prizes.index');
    Route::get('/admin/prizes/create', [App\Http\Controllers\PrizeController::class, 'create'])->name('prizes.create');
    Route::post('/admin/prizes', [App\Http\Controllers\PrizeController::class, 'store'])->name('prizes.store');
    Route::get('/admin/prizes/{prize}/edit', [App\Http\Controllers\PrizeController::class, 'edit'])->name('prizes.edit');
    Route::put('/admin/prizes/{prize}', [App\Http\Controllers\PrizeController::class, 'update'])->name('prizes.update');

    Route::get('/admin/draw-results', [App\Http\Controllers\DrawResultController::class, 'index'])->name('draw-results.index');
    Route::get('/admin/draw-results/create', [App\Http\Controllers\DrawResultController::class, 'create'])->name('draw-results.create');
    Route::post('/admin/draw-results', [App\Http\Controllers\DrawResultController::class, 'store'])->name('draw-results.store');
    Route::get('/admin/draw-results/{draw-result}/edit', [App\Http\Controllers\DrawResultController::class, 'edit'])->name('draw-results.edit');
    Route::put('/admin/draw-results/{draw-result}', [App\Http\Controllers\DrawResultController::class, 'update'])->name('draw-results.update');

    Route::get('/admin/draws', [App\Http\Controllers\DrawController::class, 'index'])->name('draws.index');
    Route::get('/admin/draws/create', [App\Http\Controllers\DrawController::class, 'create'])->name('draws.create');
    Route::get('/admin/draws-by-denomination', [App\Http\Controllers\DrawController::class, 'getDrawsByDenomination'])->name('draws.by-denomination');
    Route::post('/admin/draws', [App\Http\Controllers\DrawController::class, 'store'])->name('draws.store');
    Route::get('/admin/draws/{draw}/edit', [App\Http\Controllers\DrawController::class, 'edit'])->name('draws.edit');
    Route::put('/admin/draws/{draw}', [App\Http\Controllers\DrawController::class, 'update'])->name('draws.update');

});
