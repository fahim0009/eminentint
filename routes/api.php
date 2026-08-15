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
use App\Http\Controllers\Api\ServiceApiController;
use App\Http\Controllers\Api\ContactApiController;
use App\Http\Controllers\Api\EmployerZoneApiController;
use App\Http\Controllers\Api\DualFeatureApiController;
use App\Http\Controllers\Api\WorkforceStatementApiController;
use App\Http\Controllers\Api\PartnerApiController;
use App\Http\Controllers\Api\TestimonialApiController;
use App\Http\Controllers\Api\EmployerDemandApiController;
use App\Http\Controllers\Api\CandidateApplicationApiController;
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
Route::get('services', [ServiceApiController::class, 'getServices']);
Route::post('contact-store', [ContactApiController::class, 'submitContactForm']);

// Employer Zone APIs
Route::get('employer-advantages', [EmployerZoneApiController::class, 'getAdvantages']);
Route::get('recruitment-steps', [EmployerZoneApiController::class, 'getRecruitmentSteps']);
Route::get('track-records', [EmployerZoneApiController::class, 'getTrackRecords']);

// New Dynamic Sections APIs
Route::get('dual-feature', [DualFeatureApiController::class, 'getDualFeature']);
Route::get('workforce-statement', [WorkforceStatementApiController::class, 'getWorkforceStatement']);
Route::get('partners', [PartnerApiController::class, 'getPartners']);
Route::get('testimonials', [TestimonialApiController::class, 'getTestimonials']);

Route::post('employer-demand', [EmployerDemandApiController::class, 'store']);
Route::post('candidate-apply', [CandidateApplicationApiController::class, 'store']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', [AuthContoller::class, 'user']);
});