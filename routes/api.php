<?php

use App\Http\Controllers\Api\AuthContoller;
use App\Http\Controllers\Api\CompanyDtlApiController;
use App\Http\Controllers\Api\JobListingApiController;
use App\Http\Controllers\Api\CountryApiController;
use App\Http\Controllers\Api\CompanyLicenseApiController;
use App\Http\Controllers\Api\GalleryCategoryApiController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\AboutApiController; // Add this
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthContoller::class, 'login']);

// Public APIs
Route::get('company-details', [CompanyDtlApiController::class, 'getCompanyDetails']);
Route::get('job-listings', [JobListingApiController::class, 'getJobListings']);
Route::get('countries', [CountryApiController::class, 'getCountries']);
Route::get('licenses', [CompanyLicenseApiController::class, 'getLicenses']);
Route::get('gallery-categories', [GalleryCategoryApiController::class, 'getCategories']);
Route::get('galleries', [GalleryApiController::class, 'getGalleries']);

// About Page APIs
Route::get('about-page', [AboutApiController::class, 'getAboutPage']);
Route::get('milestones', [AboutApiController::class, 'getMilestones']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', [AuthContoller::class, 'user']);
});