<?php

use App\Http\Controllers\Api\AuthContoller;
use App\Http\Controllers\Api\CompanyDtlApiController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthContoller::class, 'login']);
Route::get('company-details', [CompanyDtlApiController::class, 'getCompanyDetails']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', [AuthContoller::class, 'user']);
});