<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\AdminDashboardController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\WalletController;
use \App\Http\Controllers\CampusController;
use \App\Http\Controllers\CourseController;

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

//Landing Page Here
Route::get('/', function () {
    return 'welcome';
})->name('welcome');

//Authentication Routes
Route::prefix('auth')->middleware(['only_visitant'])->group(function () {
    Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('login', [AuthController::class, 'postAuthenticate'])->name('post.login');
    Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
    Route::post('register', [AuthController::class, 'postUser'])->name('post.register');
});

//User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    //Campus Routes
    Route::get('/campus', [CampusController::class, 'viewCampus'])->name('campus');
});

//Admin Routes
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'viewIndex'])->name('dash.admin');

    //User Routes
    Route::get('users', [UserController::class, 'getUsers'])->name('users');
    Route::get('user/{user}', [UserController::class, 'getUserById'])->name('get-user');
    Route::put('user/{user}', [UserController::class, 'putUser'])->name('put-user');
    Route::delete('user/{user}', [UserController::class, 'deleteUser'])->name('delete-user');

    //Wallets Routes
    Route::prefix('wallet')->group(function () {
        Route::put('update/{walletId}', [WalletController::class, 'updateWalletAsAdmin'])->name('put-wallet');
    });

    Route::prefix('course')->group(function() {
        Route::get('courses', [CourseController::class, 'getCourses'])->name('courses');
        Route::get('edit/{courseId}', [CourseController::class, 'getCourse'])->name('edit-course');
        Route::get('new', [CourseController::class, 'viewAddCourse'])->name('add-course');
        Route::post('new', [CourseController::class, 'postCourse'])->name('post-course');
        Route::get('delete/{courseId}', [CourseController::class, 'deleteCourse'])->name('delete-course');
    });
});
