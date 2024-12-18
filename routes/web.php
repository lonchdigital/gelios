<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PricesController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CheckUpController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\SurgeryController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WebPagesController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\OneCenterController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\InsuranceCompaniesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::name('auth.')->prefix('/admin')->group(function () {
    Auth::routes(['register' => false, 'reset' => false]);
});

Route::post('/feedback-store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/categories-by-type', [DoctorController::class, 'getCategoriesByType'])->name('categories.by.type');
Route::get('/get-doctors-by-category/{categoryId}', [DoctorController::class, 'getDoctorsByCategory']);

Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath',
            // 'forceLocalePrefix'
            ]
    ], function () {

        Route::get('/', [HomeController::class, 'index'])->name('main');

        Route::get('/one-center/{slug}', [OneCenterController::class, 'page'])->name('one.center.page');

        Route::get('/about-us/', [AboutUsController::class, 'page'])->name('about.us.page');

        Route::get('/strahovym-kompaniyam/', [InsuranceCompaniesController::class, 'page'])->name('strahovym.kompaniyam.page');

        Route::get('/otzyvy/', [ReviewsController::class, 'page'])->name('reviews.page');
        Route::post('/user-write-review/', [ReviewsController::class, 'userWriteReview']);

        Route::get('/prices/', [PricesController::class, 'page'])->name('prices.page');
        Route::post('/prices-search-filter/', [PricesController::class, 'searchFilter']);

        Route::get('/contacts/', [ContactsController::class, 'page'])->name('contacts.page');
        Route::post('/contacts-search-filter/', [ContactsController::class, 'searchFilter']);

        Route::get('/offices/', [OfficesController::class, 'page'])->name('offices.page');

        Route::get('/staczionar/', [HospitalController::class, 'show'])->name('hospital.show');

        Route::get('/directions/', [DirectionController::class, 'page'])->name('directions.page');
        // TODO:: use them for redirects
        // Route::get('/direction/{pageDirection:slug}', [DirectionController::class, 'direction'])->name('direction.itself');
        // Route::get('/direction/category/{pageDirection:slug}', [DirectionController::class, 'category'])->name('direction.category');
        // Route::get('/direction/sub-category/{pageDirection:slug}', [DirectionController::class, 'subCategory'])->name('direction.sub-category');

        Route::get('/akczii-i-speczialnye-predlozheniya/', [PromotionController::class, 'index'])->name('promotions.index');
        Route::get('/akczii-i-speczialnye-predlozheniya/{promotion:slug}', [PromotionController::class, 'show'])->name('promotions.show');

        Route::get('/check-up/', [CheckUpController::class, 'index'])->name('check-ups.index');

        Route::get('/dlya-paczientov/', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/dlya-paczientov/page/{page}', [ArticleController::class, 'index'])->name('articles.page');
        Route::get('/dlya-paczientov/{slug}', [ArticleController::class, 'show'])->name('articles.show');

        Route::get('/nashi-speczialisty/', [DoctorController::class, 'index'])->name('doctors.index');
        Route::get('/nashi-speczialisty/{doctor:slug}', [DoctorController::class, 'show'])->name('doctors.show');

        Route::get('/laboratories/', [LaboratoryController::class, 'index'])->name('laboratories.index');

        Route::get('/vzroslym/hirurgiya/', [SurgeryController::class, 'index'])->name('surgery.index');

        Route::get('/vzroslym/hirurgiya/', [SurgeryController::class, 'index'])->name('surgery.index');

        Route::get('/vakansii/', [VacancyController::class, 'index'])->name('vacancy.index');

        // TODO:: old route of displaying pages. Can be removed
        // Route::get('/dlya-paczientov/{page:slug}', [TextPagesController::class, 'show'])->name('text.page.show');


        // Route::get('/{slug}', [WebPagesController::class, 'webPageShow'])->name('web.page.show');
        Route::get('/{slug}', [WebPagesController::class, 'webPageByFullPath'])
            ->where('slug', '.*') // any route
            ->name('web.page.show');
});

Route::get('lang/{lang}', [LanguageController::class, 'changeLanguage'])->name('changeLanguage');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
