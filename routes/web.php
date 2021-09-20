<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\UserController;

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
Route::post('/submit_form', [SubmitController::class, 'onSubmit']);
Route::post('/check_validation', [SubmitController::class, 'validationChcekForCustomer']);

Route::group(['middleware' => 'auth'], function () {
    Route::view('/home', 'Admin.home');
    Route::view('/users', 'Admin.users');
    Route::view('/rewards_statistic', 'Admin.reward_stats');
    Route::get('/orders_datatable', [SubmitController::class, 'orderListDataTable']);
    Route::get('/users_datatable', [UserController::class, 'userListDataTable']);
    Route::get('/rewards_datatable', [SubmitController::class, 'rewardListDataTable']);
    Route::get('/rewards_stat_chart', [SubmitController::class, 'rewardStatChart']);
});