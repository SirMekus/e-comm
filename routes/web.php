<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayableItemController;



Route::get('/products', [PayableItemController::class, 'index'])->name('index');
Route::post('/submit', [PayableItemController::class, 'create'])->name('submit');
Route::post('/submit/{product}', [PayableItemController::class, 'update'])->name('update');

Route::get('/{product?}', [PayableItemController::class, 'show'])->name('home');