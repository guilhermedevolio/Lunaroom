<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;

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
    return redirect(route('login'));
});

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
    Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
});

Route::prefix('admin')->middleware(['admin'])->group(function(){
    Route::get('/', [\App\Http\Controllers\AdminDashboardController::class, 'viewIndex'])->name('dash.admin');
});
