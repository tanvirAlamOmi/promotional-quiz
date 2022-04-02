<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
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

Route::view('/', 'Website.main-deli');
Route::post('/submit_form_deli', [SubmitController::class, 'onSubmitDeli']);
Route::post('/submit_form_nkd', [SubmitController::class, 'onSubmitNkd']);
Route::post('/check_validation', [SubmitController::class, 'validationChcekForCustomer']);
Route::get('/reward_pack/{tag}', [ProductsController::class, 'getReward']);

Route::group(['middleware' => 'auth'], function () {
    Route::view('/home', 'Admin.home');
    Route::view('/users', 'Admin.users');
    Route::view('/rewards_statistic', 'Admin.reward_stats');
    Route::get('/orders_datatable/{fromDate}/{toDate}', [SubmitController::class, 'orderListDataTable']);
    Route::get('/users_datatable', [UserController::class, 'userListDataTable']);
    Route::get('/rewards_datatable', [SubmitController::class, 'rewardListDataTable']);
    Route::get('/rewards_stat_chart', [SubmitController::class, 'rewardStatChart']);
    Route::get('/products', [ProductsController::class, 'getCoupons']);
    Route::post('/update_coupons', [ProductsController::class, 'couponCodeUpdate']);

});

  // Registration... fortify
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware(['auth:'.config('fortify.guard')])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware(['auth:'.config('fortify.guard')]);
