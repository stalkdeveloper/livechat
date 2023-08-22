<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\DashboardController;
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

Route::get('/', function () {
    return redirect('/user/login');
});

/* User */
Route::prefix('user')->group(function () {
    /* For Login */
    Route::get('login', [LoginController::class, 'indexLogin'])->name('login');
    Route::post('check-login', [LoginController::class, 'login']);

    /* For Registration */

    Route::group(['middleware' => 'UserLogin'], function () {
        Route::get('logout', [LoginController::class, 'logout']);
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    });
});

