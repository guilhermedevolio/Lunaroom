<?php

use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Reports\SaleReportController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Voucher\VoucherController;
use App\Repositories\PaymentRepository;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Campus\CampusController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Course\ModuleController;
use App\Http\Controllers\Course\LessonController;

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
    return view('welcome');
})->name('welcome');

//Authentication Routes
Route::prefix('auth')->middleware(['only_visitant'])->group(function () {
    Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('login', [AuthController::class, 'postAuthenticate'])->name('post.login');
    Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
    Route::post('register', [AuthController::class, 'postUser'])->name('post.register');
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::prefix('callback')->group(function () {
    Route::post('/payment/{provider}', [PaymentController::class, 'handlePaymentCallback'])->name('payment-callback');
});

//User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/campus', [CampusController::class, 'viewCampus'])->name('campus');

    Route::prefix('course')->group(function () {
        Route::get('/my', [CourseController::class, 'getMyCourses'])->name('my-courses');
        Route::get('/{courseId}', [CourseController::class, 'getCourseWebsite'])->name('get-course');
    });

    Route::get('lesson/{lessonId}', [LessonController::class, 'getLessonById'])->name('get-lesson-website');

    Route::get('/store', [StoreController::class, 'viewStore'])->name('store');
    Route::get('/notifications', [NotificationController::class, 'viewNotifications'])->name('get-notifications');

    Route::prefix('me')->group(function () {
        Route::get('account', [ProfileController::class, 'viewUserProfile'])->name('config-user-profile');
        Route::get('public-profile', [ProfileController::class, 'viewConfigPublicProfile'])->name('config-public-profile');
        Route::post('create-profile', [ProfileController::class, 'createPublicProfile'])->name('create-public-profile');
        Route::put('update-public-profile', [ProfileController::class, 'updatePublicProfile'])->name('update-public-profile');
    });

    Route::prefix('pay')->group(function () {
        Route::get('checkout', [PaymentController::class, 'viewCheckout'])->name('view-checkout');
        Route::post('/', [PaymentController::class, 'processPayment'])->name('post-execute-transaction');
        Route::get('pix/{payloadbase64}', [PaymentController::class, 'viewPayPix'])->name('view-pay-pix');
    });

    Route::prefix('cart')->group(function () {
        Route::get('/add/{courseId}', [StoreController::class, 'addItemToCart'])->name('add-to-cart');
        Route::get('/remove/{courseId}', [StoreController::class, 'removeItemCart'])->name('remove-to-cart');
        Route::get('/summary', [StoreController::class, 'summaryCart'])->name('summary-cart');
    });

    Route::prefix('purchases')->group(function () {
        Route::get('my', [StoreController::class, 'UserPurchasesView'])->name('my-purchases');
    });
});

//Admin Routes
Route::prefix('admin')->middleware(['role:admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'viewIndex'])->name('dash.admin');

    //User Routes
    Route::get('users', [UserController::class, 'getUsers'])->name('users');
    Route::get('users/search', [UserController::class, 'searchUser'])->name('search-user');
    Route::get('user/{user}', [UserController::class, 'getUserById'])->name('get-user');
    Route::put('user/{user}', [UserController::class, 'putUser'])->name('put-user');
    Route::delete('user/{user}', [UserController::class, 'deleteUser'])->name('delete-user');

    Route::prefix('course')->group(function () {
        Route::get('courses', [CourseController::class, 'getCourses'])->name('courses');
        Route::get('new', [CourseController::class, 'viewAddCourse'])->name('add-course');
        Route::post('new', [CourseController::class, 'postCourse'])->name('post-course');
        Route::get('course/{courseId}', [CourseController::class, 'getCourse'])->name('edit-course');
        Route::put('edit/{courseId}', [CourseController::class, 'putCourse'])->name('put-course');
        Route::get('delete/{courseId}', [CourseController::class, 'deleteCourse'])->name('delete-course');
    });

    Route::prefix('module')->group(function () {
        Route::post('new', [ModuleController::class, 'postModule'])->name('post-module');
        Route::get('edit/{moduleId}', [ModuleController::class, 'getModule'])->name('get-module');
        Route::put('edit/{moduleId}', [ModuleController::class, 'putModule'])->name('put-module');
        Route::get('delete/{moduleId}', [ModuleController::class, 'deleteModule'])->name('delete-module');
    });

    Route::prefix('lesson')->group(function () {
        Route::post('new', [LessonController::class, 'postLesson'])->name('post-lesson');
        Route::get('edit/{lessonId}', [LessonController::class, 'getLesson'])->name('get-lesson');
        Route::put('edit/{lessonId}', [LessonController::class, 'putLesson'])->name('put-lesson');
        Route::get('delete/{lessonId}', [LessonController::class, 'deleteLesson'])->name('delete-lesson');
    });

    Route::prefix('voucher')->group(function () {
        Route::get('/', [VoucherController::class, 'viewCreateVoucher'])->name('create-voucher');
        Route::post('/', [VoucherController::class, 'postVoucher'])->name('post-voucher');
    });

    Route::post('/addUserCourse', [CourseController::class, 'addCourseUser'])->name('add-course-to-user');
    Route::delete('/removeUserCourse', [CourseController::class, 'removeCourseUser'])->name('remove-course-to-user');

    //Reports
    Route::prefix('reports')->group(function () {
        Route::get('invoicing', [SaleReportController::class, 'InvoicingReport'])->name('report-sales');
    });

});
