<?php

use App\Http\Controllers\DialogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Auth::routes();
Route::get('/status', [UserController::class, 'status']);
Route::get('/qrcode', [UserController::class, 'qrCode']);
Route::get('/me', [UserController::class, 'me']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
