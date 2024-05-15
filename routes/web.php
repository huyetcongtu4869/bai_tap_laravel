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
    return view('welcome');
});
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::match(['GET', 'POST'], '/add-banner', [App\Http\Controllers\Auth\UserController::class, 'add'])->name('route_banner_add');
//     Route::get('/register', 'Auth\CandidateController@index')->name('register');
// });
Route::prefix('user')->name('user.')->group(function () {
    Route::match(['GET', 'POST'], '/login', [App\Http\Controllers\Auth\UserController::class, 'login'])->name('login');
    Route::match(['GET', 'POST'], '/register', [App\Http\Controllers\Auth\UserController::class, 'register'])->name('register');
    // Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [App\Http\Controllers\Auth\UserController::class, 'logout'])->name('logout');

    // });
});Route::prefix('admin')->name('admin.')->group(function () {
    Route::match(['GET', 'POST'], '/login', [App\Http\Controllers\Auth\AdminController::class, 'login'])->name('login');
    Route::match(['GET', 'POST'], '/register', [App\Http\Controllers\Auth\AdminController::class, 'register'])->name('register');
    // Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [App\Http\Controllers\Auth\AdminController::class, 'logout'])->name('logout');

    // });
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
