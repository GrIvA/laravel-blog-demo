<?php

use App\Http\Controllers\Manage\CategoryController;
use App\Http\Controllers\Manage\TagController;
use App\Http\Controllers\Manage\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manage\MainController;

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

Route::group(['prefix' => 'manage'], function() {
    Route::get('/', [MainController::class, 'index'])->name('manage.main.index');
    Route::resource('/categories', CategoryController::class, []);
    Route::resource('/tags', TagController::class, []);
    Route::resource('/posts', PostController::class, []);
});


Route::get('/', function () {
    return view('welcome');
});
