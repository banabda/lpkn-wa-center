<?php

use App\Http\Controllers\DialogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'chat-api'], function () {

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'me']);
            Route::get('/status', [UserController::class, 'status']);
            Route::get('/qrcode', [UserController::class, 'qrCode']);
        });

        Route::group(['prefix' => 'message'], function () {
            Route::get('/', [MessageController::class, 'messages']);
            Route::get('/latest', [MessageController::class, 'latest']);
            Route::get('/text', [MessageController::class, 'sendText']);
            Route::get('/file', [MessageController::class, 'sendFile']);
            Route::get('/delete', [MessageController::class, 'delete']);
        });

        Route::group(['prefix' => 'dialog'], function () {
            Route::get('/', [DialogController::class, 'dialogs']);
            Route::get('/{chatId}', [DialogController::class, 'dialog']);
        });

    });

    Route::group(['prefix' => 'chat'], function () {

        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', [DialogController::class, 'contact']);
            Route::get('/{chatid}', [DialogController::class, 'selected']);
            Route::get('/page/{page}', [DialogController::class, 'contactPerPage']);
        });

    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/me', [UserController::class, 'getMe']);
        Route::get('/role', [UserController::class, 'getRole']);
    });

});

Route::get('/home', [HomeController::class, 'index'])->name('home');



