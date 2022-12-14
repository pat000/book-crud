<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/books');
});


/**
 * get methods
 */
Route::get('getBooks', [App\Http\Controllers\BookController::class, 'getBooks'])->name('books.data');
Route::get('getDataBook/{id}', [App\Http\Controllers\BookController::class, 'getDataBook'])->name('book.data');

/**
 * resource controllers
 */
Route::resource('books', App\Http\Controllers\BookController::class);


