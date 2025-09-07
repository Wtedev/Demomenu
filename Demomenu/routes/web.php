<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/api/products/category/{categoryId}', [MenuController::class, 'getProductsByCategory'])->name('menu.products.category');
