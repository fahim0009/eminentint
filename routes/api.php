<?php

use App\Http\Controllers\Api\AuthContoller;
use App\Http\Controllers\Api\CompanyDtlApiController;
use App\Http\Controllers\Api\JobListingApiController;
use App\Http\Controllers\Api\CountryApiController;
use App\Http\Controllers\Api\CompanyLicenseApiController;
use App\Http\Controllers\Api\GalleryCategoryApiController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\AboutApiController;
use App\Http\Controllers\Api\HeroApiController;
use App\Http\Controllers\Api\IndustryApiController;
use App\Http\Controllers\Api\ServiceApiController; // Add this
use App\Http\Controllers\Api\ContactApiController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthContoller::class, 'login']);

// Public APIs
Route::get('company-details', [CompanyDtlApiController::class, 'getCompanyDetails']);
Route::get('job-listings', [JobListingApiController::class, 'getJobListings']);
Route::get('countries', [CountryApiController::class, 'getCountries']);
Route::get('licenses', [CompanyLicenseApiController::class, 'getLicenses']);
Route::get('gallery-categories', [GalleryCategoryApiController::class, 'getCategories']);
Route::get('galleries', [GalleryApiController::class, 'getGalleries']);
Route::get('about-page', [AboutApiController::class, 'getAboutPage']);
Route::get('milestones', [AboutApiController::class, 'getMilestones']);
Route::get('hero-section', [HeroApiController::class, 'getHeroSection']);
Route::get('hero-stats', [HeroApiController::class, 'getHeroStats']);
Route::get('industries', [IndustryApiController::class, 'getIndustries']);
Route::get('services', [ServiceApiController::class, 'getServices']); // Add this
Route::post('contact-submit', [ContactApiController::class, 'submitContactForm']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', [AuthContoller::class, 'user']);
});