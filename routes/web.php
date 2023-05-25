<?php

use App\Http\Controllers\Manage\CategoryController;
use App\Http\Controllers\Manage\TagController;
use App\Http\Controllers\Manage\PostController;
use App\Http\Controllers\Manage\LanguageController;
use App\Http\Controllers\Manage\TranslateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manage\MainController;
use App\Http\Controllers\Site\PostController as SitePostController;

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

// Admin  interface
Route::group(['prefix' => 'manage', 'middleware' => 'admin'], function() {
    Route::get('/', [MainController::class, 'index'])->name('manage.main.index');
    Route::resource('/categories', CategoryController::class, []);
    Route::resource('/tags', TagController::class, []);
    Route::resource('/posts', PostController::class, []);
    Route::resource('/languages', LanguageController::class, []);
    Route::resource('/translates', TranslateController::class, []);
});

Route::group(['prefix' => '{lang}', 'middleware' => 'lang'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [UserController::class, 'create'])->name('register.create');
        Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    });
    Route::get('/article/{slug}', [SitePostController::class, 'show'])->name('posts.article');

});


Route::group(['middleware' => 'guest'], function () {
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
});

Route::get('/locale/{locale}', [LocaleController::class, 'store'])->name('locale');

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/{lang?}', [SitePostController::class, 'index'])->name('home')->middleware('lang');
