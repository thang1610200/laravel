<?php

use App\Http\Controllers\admin\CommissionAdminController;
use App\Http\Controllers\admin\CreateTicketAdminController;
use App\Http\Controllers\admin\DetailOrderAdmin;
use App\Http\Controllers\admin\DetailTicketAdmin;
use App\Http\Controllers\DetailTicketController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\admin\HomeAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\LoginAdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\LogoutAdminController;
use App\Http\Controllers\admin\ManagementOrderAdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\admin\RegisterAdminController;
use App\Http\Controllers\admin\TicketAdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ManagementPurchasedController;
use App\Http\Controllers\admin\ManagementSellTicketController;
use App\Http\Controllers\admin\ManagementTicketUser;
use App\Http\Controllers\admin\ManagementUserController;
use App\Http\Controllers\admin\WithdrawManagementController;
use App\Http\Controllers\CreateRequestWithdraw;
use App\Http\Controllers\CreateTicketUserController;
use App\Http\Controllers\DetailWithdrawUserController;
use App\Http\Controllers\ManagementSellTicketUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailUserController;
use App\Http\Controllers\ResultCheckoutController;
use App\Http\Controllers\SearchTicketController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserInformationSellTicket;
use App\Http\Controllers\WithdrawController;
use App\Http\Middleware\AuthenticationUser;
use App\Http\Middleware\CheckCaptcha;
use App\Http\Middleware\CheckDetailTicket;
use App\Http\Middleware\CheckOrder;
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

Route::group(['prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::get('/ticket/{slug}', [DetailTicketController::class, 'index'])->middleware(CheckDetailTicket::class);

    Route::get('/search-ticket', [SearchTicketController::class, 'search']);
});

Route::group(['prefix' => '/user', 'middleware' => AuthenticationUser::class], function () {
    Route::controller(WithdrawController::class)->group(function () {
        Route::get('/withdraw', 'index');

        // Route::post('/checkout/{token}', 'create');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout/{token}', 'index')->middleware(CheckOrder::class);

        Route::post('/checkout/{token}', 'create');
    });

    Route::controller(ManagementPurchasedController::class)->group(function () {
        Route::get('/management-ticket', 'index');
        Route::post('/management-ticket', 'store');
        Route::get('/show-ticket', 'getTicket');
    });

    Route::post('/order', [OrderController::class, 'create']);

    Route::get('/result/checkout', [ResultCheckoutController::class, 'index']);

    Route::controller(ManagementSellTicketUserController::class)->group(function () {
        Route::get('/management-sell-ticket', 'index');
        Route::post('/management-sell-ticket', 'store');
    });

    Route::controller(CreateTicketUserController::class)->group(function () {
        Route::get('/create-ticket', 'index');
        Route::post('/create-ticket','store');
    });

    Route::controller(OrderDetailUserController::class)->group(function (){
        Route::get('/order-detail', 'index');
    });


    Route::controller(WithdrawController::class)->group(function (){
        Route::get('/withdraw', 'index');
    });

    Route::controller(CreateRequestWithdraw::class)->group(function (){
        Route::get('/withdraw/create', 'index');
        Route::post('/withdraw/create', 'store');
    });
});

Route::controller(UserInformationSellTicket::class)->group(function (){
    Route::get('/user/infor/{link}', 'index');
});

Route::get("/logout", [LogoutController::class, 'logout']);

Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index');
        Route::post('/register', 'store')->middleware(CheckCaptcha::class);
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'store')->middleware(CheckCaptcha::class);
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('/forgot-password', 'index');
        Route::post('/forgot-password', 'store');
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('/reset', 'index');
        Route::post('/reset', 'store');
    });

    Route::get('verify', [VerifyController::class, 'index']);
});


// ======    Admin
Route::group(['prefix' => 'admin/auth'], function () {
    Route::controller(LoginAdminController::class)->group(function () {
        Route::get('/login', 'index')->name('admin-login');
        Route::post('/login', 'store');
    });

    Route::controller(RegisterAdminController::class)->group(function () {
        Route::get('/register', 'index');
        Route::post('/register', 'store');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/logout', [LogoutAdminController::class, 'logout']);
    Route::get('/', [HomeAdminController::class, 'index']);

    Route::get('/management-user', [ManagementUserController::class,'index']);

    Route::controller(ManagementSellTicketController::class)->group(function () {
        Route::get('/sell-ticket', 'index');
        Route::patch('/sell-ticket', 'update');
        Route::patch('/browse-ticket', 'updateBrowse');
    });

    Route::controller(TicketAdminController::class)->group(function () {
        Route::get('/ticket', 'index');
        Route::post('/ticket', 'sell');
        Route::get('/get-ticket', 'getTicket');
    });

    Route::controller(CommissionAdminController::class)->group(function () {
        Route::get('/commission', 'index');
        Route::post('/commission', 'store');
    });

    Route::get('/management-order', [ManagementOrderAdminController::class, 'index']);

    Route::get('/management-ticket/user/{link}',[ManagementTicketUser::class,'index']);

    Route::get('/detail-order/{order_token}', [DetailOrderAdmin::class, 'index']);

    Route::get('/detail-ticket/{slug}',[DetailTicketAdmin::class, 'index']);

    Route::controller(WithdrawManagementController::class)->group(function (){
        Route::get('/management-withdraw', 'index');
        Route::patch('/management-withdraw', 'store');
    });

    Route::get('/detail-withdraw-user/{link}',[DetailWithdrawUserController::class, 'index']);
});
