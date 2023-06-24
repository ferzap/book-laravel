<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
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

Route::get('/', [BookController::class, 'index'])->name('books');

Route::resource('/books', BookController::class);
Route::post('/books/deletes', [BookController::class, 'destroyMultiple']);

Route::resource('/categories', CategoryController::class);
Route::post('/categories/deletes', [CategoryController::class, 'destroyMultiple']);