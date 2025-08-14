<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\User\AdsController;
use App\Http\Controllers\Admin\BERController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\RobotController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CountyController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\VendorsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\FrontEndController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Property\RentAdsController;
use App\Http\Controllers\Property\SaleAdsController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\VendorInvitationController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Property\ShareAdsController;
use App\Http\Controllers\Vendor\VendorAuthController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\VendorRegistrationController;
use App\Http\Controllers\Admin\PortalSettingController;
use App\Http\Controllers\Property\PropertiesController;
use App\Http\Controllers\Admin\BlogCategoriesController;
use App\Http\Controllers\Admin\ServicesCategoryController;
use App\Http\Controllers\Agent\AgentRegistrationController;
use App\Http\Controllers\Admin\RegistraionRequestController;
use App\Http\Controllers\Admin\ServicesSubCategoryController;
use App\Http\Controllers\Agent\AgentAuthController;
use App\Http\Controllers\Property\CommercialRentAdsController;
use App\Http\Controllers\Property\CommercialSaleAdsController;

// Front End Routes
Route::get('/', [HomePageController::class, 'index'])->name('home');

// User Auth Routes
Route::post('/registration', [UserController::class, 'store'])->name('registration.process');
Route::post('/login', [UserController::class, 'login'])->name('login.process');
Route::get('/verify-email/{token}/{email}', [UserController::class, 'verifyEmail'])->name('verify.email');
Route::post('/verify-email-confirm', [UserController::class, 'verifyEmailConfirm'])->name('verify.email.confirm');
Route::post('/forgot-password', [UserController::class, 'forgotPasswordRequest'])->name('password.reset.request');
Route::get('/reset-password/{token}/{email}', [UserController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password/{token}/{email}', [UserController::class, 'resetPasswordUpdate'])->name('password.reset.update');

// Vendor Registration Routes

Route::prefix('vendor')->group(function () {

    // Redirect if Authenticated Routes
    Route::middleware('redirect:vendor')->group(function () {
        Route::get('/login', [VendorAuthController::class, 'vendorLogin'])->name('vendor.login');
        Route::get('/forgot-password', [VendorAuthController::class, 'vendorForgotPassword'])->name('vendor.forgot.password');
        Route::get('/request', [VendorRegistrationController::class, 'showVendorRegistrationForm'])->name('vendor.registration.request');
    });

    // Vendor Registration Request Routes
    Route::post('/request', [VendorRegistrationController::class, 'vendorRegistrationRequestSubmit'])->name('vendor.registration.request.submit');
    Route::get('/registration/{token}', [VendorRegistrationController::class, 'showRegistrationForm'])->name('vendor.registration');
    Route::post('/registration/{token}', [VendorRegistrationController::class, 'vendorRegistrationSubmit'])->name('vendor.register.submit');

    // Vendor Guest Routes
    Route::post('/login', [VendorAuthController::class, 'vendorLoginProcess'])->name('vendor.login.process');
    Route::post('/forgot-password', [VendorAuthController::class, 'vendorForgotPasswordRequest'])->name('vendor.password.reset.request');
    Route::get('/reset-password/{token}/{email}', [VendorAuthController::class, 'vendorResetPassword'])->name('vendor.password.reset');
    Route::post('/reset-password/{token}/{email}', [VendorAuthController::class, 'vendorResetPasswordUpdate'])->name('vendor.password.reset.update');

    Route::middleware('vendor')->group(function () {
        Route::get('/dashboard', [VendorAuthController::class, 'dashboard'])->name('vendor.dashboard');
        Route::get('/logout', [VendorAuthController::class, 'logout'])->name('vendor.logout');
        Route::get('/profile', [VendorAuthController::class, 'profile'])->name('vendor.profile');
        Route::post('/profile', [VendorAuthController::class, 'profileUpdate'])->name('vendor.profile.update');
        Route::post('/change-password', [VendorAuthController::class, 'changePasswordUpdate'])->name('vendor.change.password');
    });
});


Route::prefix('agent')->group(function () {

    // Redirect if Authenticated Routes
    Route::middleware('redirect:agent')->group(function () {
        Route::get('/login', [VendorAuthController::class, 'vendorLogin'])->name('vendor.login');
        Route::get('/forgot-password', [AgentAuthController::class, 'agentForgotPassword'])->name('agent.forgot.password');
    });

    // Agent Registration Request Routes
    Route::get('registration/{token}', [AgentRegistrationController::class, 'index'])->name('agent.registration');
    Route::post('registration/{token}', [AgentRegistrationController::class, 'register'])->name('agent.register');

    // Agent Guest Routes
    Route::post('/login', [AgentAuthController::class, 'agentLoginProcess'])->name('agent.login.process');
    Route::post('/forgot-password', [AgentAuthController::class, 'agentForgotPasswordRequest'])->name('agent.password.reset.request');
    Route::get('/reset-password/{token}/{email}', [AgentAuthController::class, 'agentResetPassword'])->name('agent.password.reset');
    Route::post('/reset-password/{token}/{email}', [AgentAuthController::class, 'agentResetPasswordUpdate'])->name('agent.password.reset.update');

    Route::middleware('agent')->group(function () {
        Route::get('/dashboard', [AgentAuthController::class, 'dashboard'])->name('agent.dashboard');
        Route::get('/logout', [AgentAuthController::class, 'logout'])->name('agent.logout');
        Route::get('/profile', [AgentAuthController::class, 'profile'])->name('agent.profile');
        Route::post('/profile', [AgentAuthController::class, 'profileUpdate'])->name('agent.profile.update');
        Route::post('/change-password', [AgentAuthController::class, 'changePasswordUpdate'])->name('agent.change.password');
    });
});

Route::prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        // User Auth Routes
        Route::get('/dashboard', [UserProfileController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/logout', [UserProfileController::class, 'logout'])->name('user.logout');
        // User Profile Routes
        Route::get('/profile', [UserProfileController::class, 'profile'])->name('user.profile');
        Route::post('/profile', [UserProfileController::class, 'profileUpdate'])->name('user.profile.update');

        // Change Password Routes
        Route::post('/change-password', [UserProfileController::class, 'changePasswordUpdate'])->name('user.change.password');

        // My Property Routes
        Route::get('/my-property', [AdsController::class, 'myProperty'])->name('user.my.property');

        // Selelct Ads Type Route
        Route::get('/select-ads-type', [AdsController::class, 'selectAdsType'])->name('user.select.ads.type');

        // Residetial Rent Ads Route
        Route::get('/residential-rent-ads', [RentAdsController::class, 'residentialRentAds'])->name('user.residential.rent.ads');
        Route::post('/residetial-rent-ads', [RentAdsController::class, 'residentialRentAdsStore'])->name('user.residential.rent.ads.store');
        Route::post('/ads/upload-images', [RentAdsController::class, 'uploadImages'])->name('ads.uploadImages');

        // Residetial Sale Ads Route
        Route::get('/residential-sale-ads', [SaleAdsController::class, 'residentialSaleAds'])->name('user.residential.sale.ads');
        Route::post('/residential-sale-ads', [SaleAdsController::class, 'residentialSaleAdsStore'])->name('user.residential.sale.ads.store');

        // Residential Share Ads Route
        Route::get('/residential-share-ads', [ShareAdsController::class, 'residentialShareAds'])->name('user.residential.share.ads');
        Route::post('/residential-share-ads', [ShareAdsController::class, 'residentialShareAdsStore'])->name('user.residential.share.ads.store');

        // Commercial Rent Ads Route
        Route::get('/commercial-rent-ads', [CommercialRentAdsController::class, 'commercialRentAds'])->name('user.commercial.rent.ads');
        Route::post('/commercial-rent-ads', [CommercialRentAdsController::class, 'commercialRentAdsStore'])->name('user.commercial.rent.ads.store');

        // Commercial Sale Ads Route
        Route::get('/commercial-sale-ads', [CommercialSaleAdsController::class, 'commercialSaleAds'])->name('user.commercial.sale.ads');
        Route::post('/commercial-sale-ads', [CommercialSaleAdsController::class, 'commercialSaleAdsStore'])->name('user.commercial.sale.ads.store');

        // Favorite Ads Route
        Route::post('/property/toggle-favorite', [FavoriteController::class, 'toggleFavorite'])->name('property.toggle-favorite');
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

        // Property Inquiries Route
        Route::post('/inquiries/{property_id}', [PropertiesController::class, 'sendInquiries'])->name('user.inquiries');
    });
});

// Redirect if Authenticated Routes For Users
Route::middleware('redirect:web')->group(function () {
    Route::get('/login', [HomePageController::class, 'login'])->name('login');
    Route::get('/registration', [HomePageController::class, 'registration'])->name('registration');
    Route::get('/forgot-password', [HomePageController::class, 'forgotPassword'])->name('forgot.password');
});



Route::prefix('admin')->group(function () {
    Route::middleware('admin')->group(function () {
        // Admin Auth Routes
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        // Admin Profile Routes
        Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
        Route::post('/profile', [AdminProfileController::class, 'profileUpdate'])->name('admin.profile.update');

        // Change Password Routes
        Route::get('/change-password', [AdminProfileController::class, 'changePassword'])->name('admin.change.password');
        Route::post('/change-password', [AdminProfileController::class, 'changePasswordUpdate'])->name('admin.change.password.update');

        // Category Routes
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/category/create/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/category/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/category/{category}', [CategoryController::class, 'delete'])->name('admin.category.delete');

        // Services Category Routes
        Route::get('/services-category', [ServicesCategoryController::class, 'index'])->name('admin.services-category');
        Route::get('/services-category/create', [ServicesCategoryController::class, 'create'])->name('admin.services-category.create');
        Route::post('/services-category/create/store', [ServicesCategoryController::class, 'store'])->name('admin.services-category.store');
        Route::get('/services-category/{category}/edit', [ServicesCategoryController::class, 'edit'])->name('admin.services-category.edit');
        Route::post('/services-category/{category}', [ServicesCategoryController::class, 'update'])->name('admin.services-category.update');
        Route::get('/services-category/{category}', [ServicesCategoryController::class, 'delete'])->name('admin.services-category.delete');

        // Services Sub Category Routes
        Route::get('/services-sub-category', [ServicesSubCategoryController::class, 'index'])->name('admin.services-sub-category');
        Route::get('/services-sub-category/create', [ServicesSubCategoryController::class, 'create'])->name('admin.services-sub-category.create');
        Route::post('/services-sub-category/create/store', [ServicesSubCategoryController::class, 'store'])->name('admin.services-sub-category.store');
        Route::get('/services-sub-category/{category}/edit', [ServicesSubCategoryController::class, 'edit'])->name('admin.services-sub-category.edit');
        Route::post('/services-sub-category/{category}', [ServicesSubCategoryController::class, 'update'])->name('admin.services-sub-category.update');
        Route::get('/services-sub-category/{category}', [ServicesSubCategoryController::class, 'delete'])->name('admin.services-sub-category.delete');

        // Features Routes
        Route::get('/features', [FeatureController::class, 'index'])->name('admin.features');
        Route::get('/features/create', [FeatureController::class, 'create'])->name('admin.features.create');
        Route::post('/features/create/store', [FeatureController::class, 'store'])->name('admin.features.store');
        Route::get('/features/{feature}/edit', [FeatureController::class, 'edit'])->name('admin.features.edit');
        Route::post('/features/{feature}', [FeatureController::class, 'update'])->name('admin.features.update');
        Route::get('/features/{feature}', [FeatureController::class, 'delete'])->name('admin.features.delete');

        // Facility Routes
        Route::get('/facility', [FacilityController::class, 'index'])->name('admin.facility');
        Route::get('/facility/create', [FacilityController::class, 'create'])->name('admin.facility.create');
        Route::post('/facility/create/store', [FacilityController::class, 'store'])->name('admin.facility.store');
        Route::get('/facility/{facility}/edit', [FacilityController::class, 'edit'])->name('admin.facility.edit');
        Route::post('/facility/{facility}', [FacilityController::class, 'update'])->name('admin.facility.update');
        Route::get('/facility/{facility}', [FacilityController::class, 'delete'])->name('admin.facility.delete');

        // Settings Routes
        Route::get('/settings', [PortalSettingController::class, 'index'])->name('admin.settings');

        // Location Routes
        Route::get('/counties', [CountyController::class, 'index'])->name('admin.counties');
        Route::get('/counties/create', [CountyController::class, 'create'])->name('admin.counties.create');
        Route::post('/counties/create/store', [CountyController::class, 'store'])->name('admin.counties.store');
        Route::get('/counties/{county}/edit', [CountyController::class, 'edit'])->name('admin.counties.edit');
        Route::post('/counties/{county}', [CountyController::class, 'update'])->name('admin.counties.update');
        Route::get('/counties/{county}', [CountyController::class, 'delete'])->name('admin.counties.delete');

        // Areas Routes
        Route::get('/areas', [AreaController::class, 'index'])->name('admin.areas');
        Route::get('/areas/create', [AreaController::class, 'create'])->name('admin.areas.create');
        Route::post('/areas/create/store', [AreaController::class, 'store'])->name('admin.areas.store');
        Route::get('/areas/{area}/edit', [AreaController::class, 'edit'])->name('admin.areas.edit');
        Route::post('/areas/{area}', [AreaController::class, 'update'])->name('admin.areas.update');
        Route::get('/areas/{area}', [AreaController::class, 'delete'])->name('admin.areas.delete');

        // Property Types Routes
        Route::get('/property-types', [PropertyTypeController::class, 'index'])->name('admin.property-types');
        Route::get('/property-types/create', [PropertyTypeController::class, 'create'])->name('admin.property-types.create');
        Route::post('/property-types/create/store', [PropertyTypeController::class, 'store'])->name('admin.property-types.store');
        Route::get('/property-types/{propertyType}/edit', [PropertyTypeController::class, 'edit'])->name('admin.property-types.edit');
        Route::post('/property-types/{propertyType}', [PropertyTypeController::class, 'update'])->name('admin.property-types.update');
        Route::get('/property-types/{propertyType}', [PropertyTypeController::class, 'delete'])->name('admin.property-types.delete');

        // Users Managment Routes
        Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
        Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
        Route::post('/users/{user}', [UsersController::class, 'update'])->name('admin.users.update');
        Route::get('/users/{user}', [UsersController::class, 'delete'])->name('admin.users.delete');

        // Users Managment Routes
        Route::get('/vendors', [VendorsController::class, 'index'])->name('admin.vendors');
        Route::get('/vendors/{vendor}/edit', [VendorsController::class, 'edit'])->name('admin.vendors.edit');
        Route::post('/vendors/{vendor}', [VendorsController::class, 'update'])->name('admin.vendors.update');
        Route::get('/vendors/{vendor}', [VendorsController::class, 'delete'])->name('admin.vendors.delete');

        // Property Managment Routes
        Route::get('/properties-in-review', [PropertyController::class, 'inReview'])->name('admin.property-in-review');
        Route::get('/properties-disapproved', [PropertyController::class, 'disapproved'])->name('admin.property-disapproved');
        Route::get('/properties', [PropertyController::class, 'index'])->name('admin.properties');
        Route::get('/properties/{property}/preview', [PropertyController::class, 'preview'])->name('admin.properties.preview');
        Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('admin.properties.edit');
        Route::post('/properties/{property}', [PropertyController::class, 'update'])->name('admin.properties.update');
        Route::post('/properties/{property}', [PropertyController::class, 'statusUpdate'])->name('admin.properties.status.update');
        Route::get('/properties/{property}', [PropertyController::class, 'delete'])->name('admin.properties.delete');

        // Registraion Request Routes
        Route::get('/registration-requests', [RegistraionRequestController::class, 'index'])->name('admin.registration-requests');
        Route::get('/registration-requests/{registrationRequest}', [RegistraionRequestController::class, 'delete'])->name('admin.registration-requests.delete');

        // Hero Section Routes
        Route::get('/hero-section', [FrontEndController::class, 'heroSectionEdit'])->name('admin.settings.hero-section.edit');
        Route::post('/hero-section', [FrontEndController::class, 'HeroSectionUpdate'])->name('admin.settings.hero-section.update');

        // Feature Property Section Routes
        Route::get('/feature-property-section', [FrontEndController::class, 'featurePropertySectionEdit'])->name('admin.settings.feature-property-section.edit');
        Route::post('/feature-property-section', [FrontEndController::class, 'FeaturePropertySectionUpdate'])->name('admin.settings.feature-property-section.update');

        // Area Section Routes
        Route::get('/area-section', [FrontEndController::class, 'areaSectionEdit'])->name('admin.settings.area-section.edit');
        Route::post('/area-section', [FrontEndController::class, 'AreaSectionUpdate'])->name('admin.settings.area-section.update');

        // Social Media Section
        Route::get('/social-media', [SocialMediaController::class, 'index'])->name('admin.settings.social-media');
        Route::get('/social-media/create', [SocialMediaController::class, 'create'])->name('admin.settings.social-media.create');
        Route::post('/social-media/create/store', [SocialMediaController::class, 'store'])->name('admin.settings.social-media.store');
        Route::get('/social-media/{socialMedia}/edit', [SocialMediaController::class, 'edit'])->name('admin.settings.social-media.edit');
        Route::post('/social-media/{socialMedia}', [SocialMediaController::class, 'update'])->name('admin.settings.social-media.update');
        Route::get('/social-media/{socialMedia}', [SocialMediaController::class, 'delete'])->name('admin.settings.social-media.delete');

        // Pages Section
        Route::get('/pages', [PagesController::class, 'index'])->name('admin.pages');
        Route::get('/pages/create', [PagesController::class, 'create'])->name('admin.pages.create');
        Route::post('/pages/create/store', [PagesController::class, 'store'])->name('admin.pages.store');
        Route::get('/pages/{page}/edit', [PagesController::class, 'edit'])->name('admin.pages.edit');
        Route::post('/pages/{page}', [PagesController::class, 'update'])->name('admin.pages.update');
        Route::get('/pages/{page}', [PagesController::class, 'delete'])->name('admin.pages.delete');

        // BER Section
        Route::get('/ber', [BERController::class, 'index'])->name('admin.ber');
        Route::get('/ber/create', [BERController::class, 'create'])->name('admin.ber.create');
        Route::post('/ber/create/store', [BERController::class, 'store'])->name('admin.ber.store');
        Route::get('/ber/{ber}/edit', [BERController::class, 'edit'])->name('admin.ber.edit');
        Route::post('/ber/{ber}', [BERController::class, 'update'])->name('admin.ber.update');
        Route::get('/ber/{ber}', [BERController::class, 'delete'])->name('admin.ber.delete');

        // Cookies Section
        Route::get('/cookies-section', [FrontEndController::class, 'cookiesSectionEdit'])->name('admin.settings.cookies-section.edit');
        Route::post('/cookies-section', [FrontEndController::class, 'CookiesSectionUpdate'])->name('admin.settings.cookies-section.update');

        // Seo Section
        Route::get('/seo-section', [FrontEndController::class, 'seoSectionEdit'])->name('admin.settings.seo-section.edit');
        Route::post('/seo-section', [FrontEndController::class, 'SeoSectionUpdate'])->name('admin.settings.seo-section.update');

        // General Section
        Route::get('/general-section', [FrontEndController::class, 'generalSectionEdit'])->name('admin.settings.general-section.edit');
        Route::post('/general-section', [FrontEndController::class, 'GeneralSectionUpdate'])->name('admin.settings.general-section.update');

        // Maintenance Section
        Route::get('/maintenance-section', [FrontEndController::class, 'maintenanceSectionEdit'])->name('admin.settings.maintenance-section.edit');
        Route::post('/maintenance-section', [FrontEndController::class, 'MaintenanceSectionUpdate'])->name('admin.settings.maintenance-section.update');

        // Email Settings
        Route::get('/email-settings', [FrontEndController::class, 'emailSettingsEdit'])->name('admin.settings.email-settings.edit');
        Route::post('/email-settings', [FrontEndController::class, 'EmailSettingsUpdate'])->name('admin.settings.email-settings.update');

        // Robot.txt Settings
        Route::post('/robots-editor', [RobotController::class, 'update'])->name('admin.settings.robots.update');

        // Blogs Routes
        Route::get('/blogs', [BlogsController::class, 'index'])->name('admin.blogs-posts');
        Route::get('/blogs/create', [BlogsController::class, 'create'])->name('admin.blogs-posts.create');
        Route::post('/blogs/create/store', [BlogsController::class, 'store'])->name('admin.blogs-posts.store');
        Route::get('/blogs/{blog}/edit', [BlogsController::class, 'edit'])->name('admin.blogs-posts.edit');
        Route::post('/blogs/{blog}', [BlogsController::class, 'update'])->name('admin.blogs-posts.update');
        Route::get('/blogs/{blog}', [BlogsController::class, 'delete'])->name('admin.blogs-posts.delete');

        // Bolg Categories Routes
        Route::get('/blog-categories', [BlogCategoriesController::class, 'index'])->name('admin.blog-categories');
        Route::get('/blog-categories/create', [BlogCategoriesController::class, 'create'])->name('admin.blog-categories.create');
        Route::post('/blog-categories/create/store', [BlogCategoriesController::class, 'store'])->name('admin.blog-categories.store');
        Route::get('/blog-categories/{blogCategory}/edit', [BlogCategoriesController::class, 'edit'])->name('admin.blog-categories.edit');
        Route::post('/blog-categories/{blogCategory}', [BlogCategoriesController::class, 'update'])->name('admin.blog-categories.update');
        Route::get('/blog-categories/{blogCategory}', [BlogCategoriesController::class, 'delete'])->name('admin.blog-categories.delete');

        // Contacts Settings Routes
        Route::get('/contact-settings', [FrontEndController::class, 'contactSettingsEdit'])->name('admin.settings.contact-settings.edit');
        Route::post('/contact-settings', [FrontEndController::class, 'ContactSettingsUpdate'])->name('admin.settings.contact-settings.update');

        // Vendor Registration Routes
        Route::get('/vendor/invite/{id}', [VendorInvitationController::class, 'create'])->name('admin.vendor.invite');
        Route::post('/vendor/invite', [VendorInvitationController::class, 'store'])->name('admin.vendor.invite.send');

        // Agent Routes
        Route::get('/agents', [AgentController::class, 'index'])->name('admin.agents');
        Route::get('/agents/{agent}/edit', [AgentController::class, 'edit'])->name('admin.agents.edit');
        Route::post('/agents/{agent}', [AgentController::class, 'update'])->name('admin.agents.update');
        Route::get('/agents/{agent}', [AgentController::class, 'delete'])->name('admin.agents.delete');


        // Agreement Route
        Route::get('/agreements/create', [AgreementController::class, 'create'])->name('admin.agreements.create');
        Route::post('/agreements', [AgreementController::class, 'store'])->name('admin.agreements.store');

        // Get Slug
        Route::get('/get-slug', function (Request $request) {
            if ($request->has('title')) {
                $slug = Str::slug($request->title);
            }

            return response()->json([
                'status' => 'success',
                'slug' => $slug
            ]);
        })->name('get.slug');
    });

    // Redirect if Authenticated Routes
    Route::middleware('redirect:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'login'])->middleware('throttle:5,1')->name('admin.login');
        Route::get('/forgot-password', [AdminAuthController::class, 'forgotPassword'])->name('admin.forgot.password');
    });

    // Admin Guest Routes
    Route::post('/login', [AdminAuthController::class, 'loginProcess'])->name('admin.login.process');
    Route::post('/forgot-password', [AdminAuthController::class, 'forgotPasswordRequest'])->name('admin.forgot.password.request');
    Route::get('/reset-password/{token}/{email}', [AdminAuthController::class, 'resetPassword'])->name('admin.reset.password');
    Route::post('/reset-password/{token}/{email}', [AdminAuthController::class, 'resetPasswordProcess'])->name('admin.reset.password.process');
});

// Guest Routes

Route::get('/page/{slug}', [HomePageController::class, 'page'])->name('front.page');
Route::get('/county-wise-properties/{county}', [HomePageController::class, 'showCountyWiseProperties'])->name('properties.county');
Route::get('/properties/{adType}/{propertyType?}', [PropertiesController::class, 'showProperties'])->name('properties.index');
Route::get('/properties/{slug}', [FrontEndController::class, 'properties'])->name('properties');
Route::get('/search', [HomePageController::class, 'search'])->name('property.search');
Route::get('/{type?}/{slug}', [HomePageController::class, 'show'])->name('property.show');
Route::post('/fetch-area/{id}', [ExtraController::class, 'fetchArea']);
Route::get('/get-coordinates', [ExtraController::class, 'getCoordinates']);
Route::get('/get-slug-guest', function (Request $request) {
    if ($request->has('title')) {
        $slug = Str::slug($request->title);
    }

    return response()->json([
        'status' => 'success',
        'slug' => $slug
    ]);
})->name('get.slug.guest');


// Guest Routes
Route::get('/robots.txt', [RobotController::class, 'serve']);
