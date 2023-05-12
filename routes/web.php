<?php

use App\Http\Controllers\Manage\CategoryController;
use App\Http\Controllers\Manage\TagController;
use App\Http\Controllers\Manage\PostController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'manage', 'middleware' => 'admin'], function() {
    Route::get('/', [MainController::class, 'index'])->name('manage.main.index');
    Route::resource('/categories', CategoryController::class, []);
    Route::resource('/tags', TagController::class, []);
    Route::resource('/posts', PostController::class, []);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});


Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/', function () {
    return view('site.home');
})->name('home');
