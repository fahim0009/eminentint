<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CandidateApplicationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyDetailsController;
use App\Http\Controllers\Admin\CompanyLicenseController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DualFeatureController;
use App\Http\Controllers\Admin\EmployerAdvantageController;
use App\Http\Controllers\Admin\EmployerDemandController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\HeroStatController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\JobListingController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\MilestoneController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\RecruitmentStepController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TrackRecordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkforceStatementController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' =>'admin/', 'middleware' => ['auth', 'is_admin']], function(){
    Route::get('/dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard');

    // Admin Management Routes
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@index')->name('admin.index');
    Route::post('/admin', 'App\Http\Controllers\Admin\AdminController@store')->name('admin.store');
    Route::get('/admin/{id}/edit', 'App\Http\Controllers\Admin\AdminController@edit')->name('admin.edit');
    Route::post('/admin-update', 'App\Http\Controllers\Admin\AdminController@update')->name('admin.update');
    Route::delete('/admin/{id}', 'App\Http\Controllers\Admin\AdminController@destroy')->name('admin.delete');
    Route::post('/admin-status', 'App\Http\Controllers\Admin\AdminController@toggleStatus')->name('admin.toggleStatus');


    // User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user-update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('/user-status', [UserController::class, 'toggleStatus'])->name('user.toggleStatus');

    // Slider
    Route::get('/slider', [SliderController::class, 'getSlider'])->name('allslider');
    Route::post('/slider', [SliderController::class, 'sliderStore']);
    Route::get('/slider/{id}/edit', [SliderController::class, 'sliderEdit']);
    Route::post('/slider-update', [SliderController::class, 'sliderUpdate']);
    Route::delete('/slider/{id}', [SliderController::class, 'sliderDelete'])->name('slider.delete');
    Route::post('/slider-status', [SliderController::class, 'toggleStatus']);
    Route::post('/sliders/update-order', [SliderController::class, 'updateOrder'])->name('sliders.updateOrder');

    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contact/{id}', [ContactController::class, 'show'])->name('contact.show');
    Route::delete('/contact/{id}', [ContactController::class, 'delete'])->name('contact.delete');

    // FAQ
    Route::get('/faq', [FAQController::class, 'index'])->name('faq.index');
    Route::post('/faq', [FAQController::class, 'store'])->name('faq.store');
    Route::get('/faq/{id}/edit', [FAQController::class, 'edit'])->name('faq.edit');
    Route::post('/faq-update', [FAQController::class, 'update'])->name('faq.update');
    Route::delete('/faq/{id}', [FAQController::class, 'destroy'])->name('faq.delete');

    Route::get('/company-details', [CompanyDetailsController::class, 'index'])->name('admin.companyDetails');
    Route::post('/company-details', [CompanyDetailsController::class, 'update'])->name('admin.companyDetails');

    Route::get('/company/seo-meta', [CompanyDetailsController::class, 'seoMeta'])->name('admin.company.seo-meta');
    Route::post('/company/seo-meta/update', [CompanyDetailsController::class, 'seoMetaUpdate'])->name('admin.company.seo-meta.update');

    Route::get('/about-us', [CompanyDetailsController::class, 'aboutUs'])->name('admin.aboutUs');
    Route::post('/about-us', [CompanyDetailsController::class, 'aboutUsUpdate'])->name('admin.aboutUs');

    Route::get('/privacy-policy', [CompanyDetailsController::class, 'privacyPolicy'])->name('admin.privacy-policy');
    Route::post('/privacy-policy', [CompanyDetailsController::class, 'privacyPolicyUpdate'])->name('admin.privacy-policy');

    Route::get('/terms-and-conditions', [CompanyDetailsController::class, 'termsAndConditions'])->name('admin.terms-and-conditions');
    Route::post('/terms-and-conditions', [CompanyDetailsController::class, 'termsAndConditionsUpdate'])->name('admin.terms-and-conditions');
    
    Route::get('/mail-body', [CompanyDetailsController::class, 'mailBody'])->name('admin.mail-body');
    Route::post('/mail-body', [CompanyDetailsController::class, 'mailBodyUpdate'])->name('admin.mail-body');

    Route::get('/home-footer', [CompanyDetailsController::class, 'homeFooter'])->name('admin.home-footer');
    Route::post('/home-footer', [CompanyDetailsController::class, 'homeFooterUpdate'])->name('admin.home-footer');

    Route::get('/copyright', [CompanyDetailsController::class, 'copyright'])->name('admin.copyright');
    Route::post('/copyright', [CompanyDetailsController::class, 'copyrightUpdate'])->name('admin.copyright');

    Route::get('/master', [MasterController::class, 'index'])->name('master.index');
    Route::post('/master', [MasterController::class, 'store'])->name('master.store');
    Route::get('/master/{id}/edit', [MasterController::class, 'edit'])->name('master.edit');
    Route::post('/master-update', [MasterController::class, 'update'])->name('master.update');
    Route::delete('/master/{id}', [MasterController::class, 'destroy'])->name('master.delete');

    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    Route::post('/sections/update-order', [SectionController::class, 'updateOrder'])->name('sections.updateOrder');
    Route::post('/sections/toggle-status', [SectionController::class, 'toggleStatus'])->name('sections.toggleStatus');

    // Category crud
    Route::get('/category', [CategoryController::class, 'index'])->name('allcategory');
    Route::get('/parent-categories', [CategoryController::class, 'parentCategories'])->name('parent.categories');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit']);
    Route::post('/category-update', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::post('/category-status', [CategoryController::class, 'toggleStatus']);

    


    // ============================================
    // ABOUT US MANAGEMENT - ROUTE ORDER MATTERS!
    // ============================================

    // About Page Content (Single Row)
    Route::get('/about-page', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about-page', [AboutController::class, 'update'])->name('about.update');

    // Milestones CRUD
    Route::get('/milestone', [MilestoneController::class, 'index'])->name('allmilestone');
    Route::post('/milestone', [MilestoneController::class, 'store'])->name('milestone.store');
    Route::get('/milestone/{id}/edit', [MilestoneController::class, 'edit']);
    Route::post('/milestone-update', [MilestoneController::class, 'update']);
    Route::delete('/milestone/{id}', [MilestoneController::class, 'delete'])->name('milestone.delete');
    Route::post('/milestone-status', [MilestoneController::class, 'toggleStatus']);

    // 9. joblisting
    Route::get('/job-listing', [JobListingController::class, 'index'])->name('alljoblisting');
    Route::post('/job-listing', [JobListingController::class, 'store'])->name('joblisting.store');
    Route::get('/job-listing/{id}/edit', [JobListingController::class, 'edit']);
    Route::post('/job-listing-update', [JobListingController::class, 'update']);
    Route::delete('/job-listing/{id}', [JobListingController::class, 'delete'])->name('joblisting.delete');
    Route::post('/job-listing-status', [JobListingController::class, 'toggleStatus']);


    Route::get('/country', [CountryController::class, 'index'])->name('allcountry');
    Route::post('/country', [CountryController::class, 'store'])->name('country.store');
    Route::get('/country/{id}/edit', [CountryController::class, 'edit']);
    Route::post('/country-update', [CountryController::class, 'update']);
    Route::delete('/country/{id}', [CountryController::class, 'delete'])->name('country.delete');
    Route::post('/country-status', [CountryController::class, 'toggleStatus']);

    Route::get('/company-license', [CompanyLicenseController::class, 'index'])->name('alllicense');
    Route::post('/company-license', [CompanyLicenseController::class, 'store'])->name('license.store');
    Route::get('/company-license/{id}/edit', [CompanyLicenseController::class, 'edit']);
    Route::post('/company-license-update', [CompanyLicenseController::class, 'update']);
    Route::delete('/company-license/{id}', [CompanyLicenseController::class, 'delete'])->name('license.delete');
    Route::post('/company-license-status', [CompanyLicenseController::class, 'toggleStatus']);


    // Gallery Categories
    Route::get('/gallery-category', [GalleryCategoryController::class, 'index'])->name('allgallerycat');
    Route::post('/gallery-category', [GalleryCategoryController::class, 'store'])->name('gallerycat.store');
    Route::get('/gallery-category/{id}/edit', [GalleryCategoryController::class, 'edit']);
    Route::post('/gallery-category-update', [GalleryCategoryController::class, 'update']);
    Route::delete('/gallery-category/{id}', [GalleryCategoryController::class, 'delete'])->name('gallerycat.delete');
    Route::post('/gallery-category-status', [GalleryCategoryController::class, 'toggleStatus']);

    // Gallery Items
    Route::get('/gallery', [GalleryController::class, 'index'])->name('allgallery');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit']);
    Route::post('/gallery-update', [GalleryController::class, 'update']);
    Route::delete('/gallery/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');
    Route::post('/gallery-status', [GalleryController::class, 'toggleStatus']);


    // Hero Section Content (Single Row)
    Route::get('/hero-page', [HeroSectionController::class, 'index'])->name('hero.index');
    Route::post('/hero-page', [HeroSectionController::class, 'update'])->name('hero.update');

    // Hero Stats CRUD
    Route::get('/hero-stat', [HeroStatController::class, 'index'])->name('allherostat');
    Route::post('/hero-stat', [HeroStatController::class, 'store'])->name('herostat.store');
    Route::get('/hero-stat/{id}/edit', [HeroStatController::class, 'edit']);
    Route::post('/hero-stat-update', [HeroStatController::class, 'update']);
    Route::delete('/hero-stat/{id}', [HeroStatController::class, 'delete'])->name('herostat.delete');
    Route::post('/hero-stat-status', [HeroStatController::class, 'toggleStatus']);

    Route::get('/industry', [IndustryController::class, 'index'])->name('allindustry');
    Route::post('/industry', [IndustryController::class, 'store'])->name('industry.store');
    Route::get('/industry/{id}/edit', [IndustryController::class, 'edit']);
    Route::post('/industry-update', [IndustryController::class, 'update']);
    Route::delete('/industry/{id}', [IndustryController::class, 'delete'])->name('industry.delete');
    Route::post('/industry-status', [IndustryController::class, 'toggleStatus']);

    Route::get('/service', [ServiceController::class, 'index'])->name('allservice');
    Route::post('/service', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/{id}/edit', [ServiceController::class, 'edit']);
    Route::post('/service-update', [ServiceController::class, 'update']);
    Route::delete('/service/{id}', [ServiceController::class, 'delete'])->name('service.delete');
    Route::post('/service-status', [ServiceController::class, 'toggleStatus']);


    // Employer Advantages (Why Choose Us)
    Route::get('/employer-advantage', [EmployerAdvantageController::class, 'index'])->name('allempladv');
    Route::post('/employer-advantage', [EmployerAdvantageController::class, 'store'])->name('empladv.store');
    Route::get('/employer-advantage/{id}/edit', [EmployerAdvantageController::class, 'edit']);
    Route::post('/employer-advantage-update', [EmployerAdvantageController::class, 'update']);
    Route::delete('/employer-advantage/{id}', [EmployerAdvantageController::class, 'delete'])->name('empladv.delete');
    Route::post('/employer-advantage-status', [EmployerAdvantageController::class, 'toggleStatus']);

    // Recruitment Steps (Process Timeline)
    Route::get('/recruitment-step', [RecruitmentStepController::class, 'index'])->name('allrecstep');
    Route::post('/recruitment-step', [RecruitmentStepController::class, 'store'])->name('recstep.store');
    Route::get('/recruitment-step/{id}/edit', [RecruitmentStepController::class, 'edit']);
    Route::post('/recruitment-step-update', [RecruitmentStepController::class, 'update']);
    Route::delete('/recruitment-step/{id}', [RecruitmentStepController::class, 'delete'])->name('recstep.delete');
    Route::post('/recruitment-step-status', [RecruitmentStepController::class, 'toggleStatus']);

    // Track Records (Partners)
    Route::get('/track-record', [TrackRecordController::class, 'index'])->name('alltrackrec');
    Route::post('/track-record', [TrackRecordController::class, 'store'])->name('trackrec.store');
    Route::get('/track-record/{id}/edit', [TrackRecordController::class, 'edit']);
    Route::post('/track-record-update', [TrackRecordController::class, 'update']);
    Route::delete('/track-record/{id}', [TrackRecordController::class, 'delete'])->name('trackrec.delete');
    Route::post('/track-record-status', [TrackRecordController::class, 'toggleStatus']);


    Route::get('/dual-feature', [DualFeatureController::class, 'index'])->name('dualfeature.index');
    Route::post('/dual-feature', [DualFeatureController::class, 'update'])->name('dualfeature.update');

// Workforce Statement (Single Row)
Route::get('/workforce-statement', [WorkforceStatementController::class, 'index'])->name('workforce.index');
Route::post('/workforce-statement', [WorkforceStatementController::class, 'update'])->name('workforce.update');


// Partners
Route::get('/partner', [PartnerController::class, 'index'])->name('allpartner');
Route::post('/partner', [PartnerController::class, 'store'])->name('partner.store');
Route::get('/partner/{id}/edit', [PartnerController::class, 'edit']);
Route::post('/partner-update', [PartnerController::class, 'update']);
Route::delete('/partner/{id}', [PartnerController::class, 'delete'])->name('partner.delete');
Route::post('/partner-status', [PartnerController::class, 'toggleStatus']);


// Testimonials
Route::get('/testimonial', [TestimonialController::class, 'index'])->name('alltestimonial');
Route::post('/testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
Route::get('/testimonial/{id}/edit', [TestimonialController::class, 'edit']);
Route::post('/testimonial-update', [TestimonialController::class, 'update']);
Route::delete('/testimonial/{id}', [TestimonialController::class, 'delete'])->name('testimonial.delete');
Route::post('/testimonial-status', [TestimonialController::class, 'toggleStatus']);

// Employer Demand Requests
Route::get('/employer-demand', [EmployerDemandController::class, 'index'])->name('alldemands');
Route::get('/employer-demand/{id}', [EmployerDemandController::class, 'show'])->name('demand.show');
Route::delete('/employer-demand/{id}', [EmployerDemandController::class, 'delete'])->name('demand.delete');


// Candidate Applications
Route::get('/candidate-application', [CandidateApplicationController::class, 'index'])->name('allapplications');
Route::get('/candidate-application/{id}', [CandidateApplicationController::class, 'show'])->name('application.show');
Route::delete('/candidate-application/{id}', [CandidateApplicationController::class, 'delete'])->name('application.delete');





});