<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BillingAddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LangsController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Voyager\DashboardController;
use App\Http\Controllers\Voyager\OrdersController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;


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
Route::get('/',function(){
    return view('home');
})->name('home');
Route::get('/team',function(){
    return view('team.index');
})->name('team');
Route::get('/faq',[PageController::class , 'faq'])->name('faq');
Route::get('/about-us',[PageController::class , 'about'])->name('about-us');
Route::get('/contact',[ContactController::class , 'index'])->name('show-contact');
Route::post('/contact', [ContactController::class, 'contact'])->middleware('web')->name('contact');
Route::get('/services',[ServiceController::class , 'index'])->name('services');
Route::get('/service/{slug}', [ServiceController::class , 'show'])->name('service')->where('slug', '[a-zA-Z0-9\-]+');
Route::get('/page/{slug}', [PageController::class , 'index'])->where('slug', '[a-zA-Z0-9\-]+')->name('page');

Route::post('search', [SearchController::class, 'search'])->name('search');

Route::prefix('customer')->group(function () {

    Route::get('/meetings-panel', [MeetingController::class, 'index'])->name('index');
    Route::get('/appointment-details', [MeetingController::class, 'showDetails'])->middleware('meeting_requirements')->name('show-Details');

    Route::middleware(['client.auth','is_verify_email'])->group(function () {
        Route::post('/appointment-details', [MeetingController::class, 'payMeeting'])->name('pay-meeting');
        Route::post('/billing-adress', [BillingAddressController::class, 'store'])->name('billing-adress');

        Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
        Route::get('/order/{order}', [OrderController::class, 'order'])->name('order')->where('order', '[0-9]{1,3}');
    });

    Route::middleware('client.guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('showRegistrationForm');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
    });

    Route::get('/logout', [LoginController::class, 'logout'])->middleware('client.auth')->name('logout');

    Route::get('/password/forgot', [LoginController::class, 'showForgotForm'])->name('showForgotForm');
    Route::post('/password/forgot', [LoginController::class, 'sendResetLink'])->name('sendResetLink');
    Route::get('/password/reset/{token}', [LoginController::class, 'showResetForm'])->name('showResetForm');
    Route::post('/password/reset', [LoginController::class, 'resePassword'])->name('resePassword');

});
Route::post('/lang' ,[LangsController::class, 'langs_handler'])->name('langs'); 

Route::get('/email/verify/{token}', [RegisterController::class, 'verifyClient'])->name('client.verify'); 

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('client_has_session')->name('verification.notice');

Route::get('/download-invoice/{order}' ,[OrderController::class, 'downloadInvoiceOrder'])->name('download-invoice')->where('order', '[0-9]{1,3}');; 

Route::post('/email/verification-notification',[RegisterController::class, 'verificationSend'])
    ->middleware(['client_has_session', 'throttle:6,1'])->name('verification.send');

Route::get('/privacy-policy', function () {
    return view('privacy_policy');
})->name('privacy.policy');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::middleware('admin.user')->group(function(){
        Route::get("/", [DashboardController::class, 'statistics'])->name('voyager.dashboard');
        Route::get("/orders-details", [OrdersController::class, 'index'])->name('orders.orders-details');
        Route::get("/order/{order}", [OrdersController::class, 'orderDetails'])->name('order.show')->where('order', '[0-9]{1,10}');
    });
});
