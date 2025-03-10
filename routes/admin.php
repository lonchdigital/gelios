<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RobotsController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CheckUpController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OfficesController;
use App\Http\Controllers\Admin\SurgeryController;
use App\Http\Controllers\Admin\VacancyController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OneCenterController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\TextPagesController;
use App\Http\Controllers\Admin\DirectionsController;
use App\Http\Controllers\Admin\LaboratoryController;
use App\Http\Controllers\Admin\CommonBlocksController;
use App\Http\Controllers\Admin\TypicalPagesController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\InsuranceCompaniesController;

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
//    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
//    Route::post('/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
//    Route::get('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

    Route::group([
       'middleware' => [
        // 'admin_auth',
        'setDefaultLanguage',
        ]
    ], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('adminDashboard');

        Route::prefix('/directions')->group(function() {
            Route::get('/page', [DirectionsController::class, 'page'])->name('directions.page.edit');
            Route::get('/', [DirectionsController::class, 'index'])->name('directions.index');
            Route::get('/category/{directionId}', [DirectionsController::class, 'category'])->name('directions.category');

            Route::get('/{directionId}/edit', [DirectionsController::class, 'edit'])->name('directions.edit');
        });
        Route::prefix('/insurance-companies')->group(function() {
            Route::get('/page', [InsuranceCompaniesController::class, 'page'])->name('insurance.companies.page.edit');

            Route::get('/', [InsuranceCompaniesController::class, 'index'])->name('insurance.companies.index');
        });
        Route::prefix('/one-center')->group(function() {
            // Route::get('/', [OneCenterController::class, 'show'])->name('one.center.show');

            Route::get('/', [OneCenterController::class, 'index'])->name('one.center.index');

            Route::get('/create', [OneCenterController::class, 'create'])->name('one.center.create');
            Route::get('/{page}/edit', [OneCenterController::class, 'edit'])->name('one.center.edit');

        });
        Route::prefix('/text-pages')->group(function() {
            Route::get('/', [TextPagesController::class, 'index'])->name('text.pages.index');
            Route::get('/{page}/edit', [TextPagesController::class, 'edit'])->name('text.pages.edit');
        });

        Route::prefix('/typical-pages')->group(function() {
            Route::get('/', [TypicalPagesController::class, 'index'])->name('typical.pages.index');

            Route::get('/create', [TypicalPagesController::class, 'create'])->name('typical.pages.create');
            Route::get('/{page}/edit', [TypicalPagesController::class, 'edit'])->name('typical.pages.edit');

            Route::get('/{page}/block/create', [TypicalPagesController::class, 'blockCreate'])->name('typical.page.block.create');
            Route::get('/{page}/block/{pageTextBlock}/edit', [TypicalPagesController::class, 'blockEdit'])->name('typical.page.block.edit');
        });

        Route::prefix('/hospitals')->group(function() {
            Route::get('/', [HospitalController::class, 'index'])->name('hospitals.index');

            Route::get('/create', [HospitalController::class, 'create'])->name('hospitals.create');
            Route::get('/{hospital}/edit', [HospitalController::class, 'editHospital'])->name('hospitals.edit');
        });

        Route::prefix('/page/{page}/prices')->group(function() {
            Route::get('/', [PriceController::class, 'index'])->name('prices.index');

            Route::get('/create', [PriceController::class, 'createTest'])->name('prices.test.create');
            Route::get('/{test}/edit', [PriceController::class, 'editTest'])->name('prices.test.edit');
        });

        Route::prefix('/contacts')->group(function() {
            Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
        });

        Route::prefix('/offices')->group(function() {
            Route::get('/', [OfficesController::class, 'index'])->name('offices.index');

            Route::get('/create', [OfficesController::class, 'createOffice'])->name('offices.create');
            Route::get('/{contact}/edit', [OfficesController::class, 'editOffice'])->name('offices.edit');
        });

        Route::prefix('/about-us')->group(function() {
            Route::get('/', [AboutUsController::class, 'edit'])->name('about.us.edit');
        });

        Route::prefix('/reviews')->group(function() {
            Route::get('/page', [ReviewController::class, 'page'])->name('reviews.page.edit');
            Route::get('/', [ReviewController::class, 'index'])->name('reviews.index');
            Route::get('/unpublished', [ReviewController::class, 'unpublishedIndex'])->name('unpublished.reviews.index');

            Route::get('/create', [ReviewController::class, 'createReview'])->name('reviews.create');
            Route::get('/{review}/edit', [ReviewController::class, 'editReview'])->name('reviews.edit');
        });

        Route::prefix('/common-blocks')->group(function() {
            Route::get('/', [CommonBlocksController::class, 'directions'])->name('common-blocks.directions');
        });

        Route::prefix('/promotions')->name('admin.promotions.')->group(function() {
            Route::get('/', [PromotionController::class, 'index'])->name('index');
            Route::get('/edit-main-seo', [PromotionController::class, 'mainPageSeo'])->name('edit-main-seo');
            Route::get('/edit-one-page-seo', [PromotionController::class, 'onePageSeo'])->name('edit-one-page-seo');

            Route::get('/edit-block/{page}/{block}', [PromotionController::class, 'editBlock'])->name('edit-block');
            Route::get('/create-slide/{page}', [PromotionController::class, 'createSlide'])->name('create-slide');
            Route::get('/edit-slide/{page}/{block}', [PromotionController::class, 'editSlide'])->name('edit-slide');

            Route::get('/create', [PromotionController::class, 'create'])->name('create');
            Route::get('/{promotion}/edit', [PromotionController::class, 'edit'])->name('edit');
        });

        Route::prefix('/check-ups')->name('admin.check-ups.')->group(function() {
            Route::get('/', [CheckUpController::class, 'index'])->name('index');
            Route::get('/edit-main-seo', [CheckUpController::class, 'mainPageSeo'])->name('edit-main-seo');
            Route::get('/edit-one-page-seo', [CheckUpController::class, 'onePageSeo'])->name('edit-one-page-seo');
            Route::get('/create', [CheckUpController::class, 'create'])->name('create');
            Route::get('/{checkUp}/edit', [CheckUpController::class, 'edit'])->name('edit');

            Route::get('/{checkUp}/create-program', [CheckUpController::class, 'createProgram'])->name('create-program');
            Route::get('/{checkUp}/edit-program/{program}', [CheckUpController::class, 'editProgram'])->name('edit-program');
        });

        Route::prefix('/article-categories')->name('admin.article-categories.')->group(function() {
            Route::get('/', [ArticleCategoryController::class, 'index'])->name('index');
            Route::get('/create', [ArticleCategoryController::class, 'create'])->name('create');
            Route::get('/{category}/edit', [ArticleCategoryController::class, 'edit'])->name('edit');
        });

        Route::prefix('/articles')->name('admin.articles.')->group(function() {
            Route::get('/', [ArticleController::class, 'index'])->name('index');

            Route::get('/edit-main-seo', [ArticleController::class, 'mainPageSeo'])->name('edit-main-seo');
            Route::get('/edit-one-page-seo', [ArticleController::class, 'onePageSeo'])->name('edit-one-page-seo');

            Route::get('/create-slide/{page}', [ArticleController::class, 'createSlide'])->name('create-slide');
            Route::get('/edit-slide/{page}/{block}', [ArticleController::class, 'editSlide'])->name('edit-slide');

            Route::get('/edit-block/{block}', [ArticleController::class, 'editBlogBlock'])->name('edit-blog-block');

            Route::get('/create', [ArticleController::class, 'create'])->name('create');
            Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');

            Route::get('/{article}/create-block', [ArticleController::class, 'createBlock'])->name('create-block');
            Route::get('/{article}/edit-block/{block}', [ArticleController::class, 'editBlock'])->name('edit-block');

            Route::get('/{article}/create-slide', [ArticleController::class, 'createArticleSlide'])->name('create-article-slide');
            Route::get('/{article}/edit-slide/{slide}', [ArticleController::class, 'editArticleSlide'])->name('edit-article-slide');
        });

        Route::prefix('/doctors')->name('admin.doctors.')->group(function() {
            Route::get('/', [DoctorController::class, 'index'])->name('index');

            Route::get('/edit-main-seo', [DoctorController::class, 'mainPageSeo'])->name('edit-main-seo');
            Route::get('/edit-one-page-seo', [DoctorController::class, 'onePageSeo'])->name('edit-one-page-seo');

            Route::get('/create', [DoctorController::class, 'create'])->name('create');
            Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('edit');
        });

        Route::prefix('/doctor-categories')->name('admin.doctor-categories.')->group(function() {
            Route::get('/', [DoctorController::class, 'categoryIndex'])->name('index');
            Route::get('/create', [DoctorController::class, 'categoryCreate'])->name('create');
            Route::get('/{category}/edit', [DoctorController::class, 'categoryEdit'])->name('edit');
        });

        Route::prefix('/specializations')->name('admin.specializations.')->group(function() {
            Route::get('/', [SpecializationController::class, 'index'])->name('index');
            Route::get('/create', [SpecializationController::class, 'create'])->name('create');
            Route::get('/{category}/edit', [SpecializationController::class, 'edit'])->name('edit');
        });

        Route::prefix('/laboratories')->name('admin.laboratories.')->group(function() {
            Route::get('/', [LaboratoryController::class, 'index'])->name('index');
            Route::get('/create', [LaboratoryController::class, 'create'])->name('create');

            Route::prefix('/prices')->name('prices.')->group(function() {
                Route::get('/edit-seo', [LaboratoryController::class, 'pricesSeo'])->name('edit-seo');
                Route::get('/', [LaboratoryController::class, 'priceIndex'])->name('index');
                Route::get('/create', [LaboratoryController::class, 'priceCreate'])->name('create');
                Route::get('/{category}/edit', [LaboratoryController::class, 'priceEdit'])->name('edit');

                Route::prefix('/{category}/item')->group(function() {
                    Route::get('/create', [LaboratoryController::class, 'itemCreate'])->name('create-item');
                    Route::get('/{item}/edit', [LaboratoryController::class, 'itemEdit'])->name('edit-item');
                });
            });

            Route::get('/edit-main-seo', [LaboratoryController::class, 'mainPageSeo'])->name('edit-main-seo');
            Route::get('/edit-one-page-seo', [LaboratoryController::class, 'onePageSeo'])->name('edit-one-page-seo');

            Route::get('/create-slide/{page}', [LaboratoryController::class, 'createSlide'])->name('create-slide');
            Route::get('/edit-slide/{page}/{block}', [LaboratoryController::class, 'editSlide'])->name('edit-slide');

            Route::get('/edit-block/{page}/{block}', [LaboratoryController::class, 'editBlock'])->name('edit-block');

            Route::get('/{laboratory}/edit', [LaboratoryController::class, 'edit'])->name('edit');
        });

        Route::prefix('/laboratory-cities')->name('admin.laboratory-cities.')->group(function() {
            Route::get('/', [LaboratoryController::class, 'cityIndex'])->name('index');
            Route::get('/create', [LaboratoryController::class, 'cityCreate'])->name('create');
            Route::get('/{city}/edit', [LaboratoryController::class, 'cityEdit'])->name('edit');
        });

        Route::prefix('/surgery')->name('admin.surgery.')->group(function() {
            Route::get('/', [SurgeryController::class, 'index'])->name('index');

            Route::get('/edit-main-seo', [SurgeryController::class, 'mainPageSeo'])->name('edit-main-seo');

            Route::get('/edit-block/{block}', [SurgeryController::class, 'edit'])->name('edit-block');

            Route::get('/create', [SurgeryController::class, 'createSurgery'])->name('create');
            Route::get('/{surgery}', [SurgeryController::class, 'showSurgery'])->name('show');
            Route::get('/{surgery}/edit', [SurgeryController::class, 'editSurgery'])->name('edit');

            Route::get('/{page}/create-static-block', [SurgeryController::class, 'createStaticBlock'])->name('create-static-block');
            // Route::get('/{page}/{block}/edit-block', [SurgeryController::class, 'editStaticBlock'])->name('edit-static-block');
            Route::get('/{page}/edit-block/{block}', [SurgeryController::class, 'editStaticBlock'])->name('edit-static-block');

            Route::get('/{page}/create-conditions-block', [SurgeryController::class, 'createConditionsBlock'])->name('create-conditions-block');
            Route::get('/{page}/edit-conditions-block/{block}', [SurgeryController::class, 'editConditionsBlock'])->name('edit-conditions-block');

            Route::get('/{page}/create-inpatient-block', [SurgeryController::class, 'createInpatientBlock'])->name('create-inpatient-block');
            Route::get('/{page}/edit-inpatient-block/{block}', [SurgeryController::class, 'editInpatientBlock'])->name('edit-inpatient-block');

            Route::get('/{surgery}/create', [SurgeryController::class, 'createSurgeryBlock'])->name('create-block');
            Route::get('/{surgery}/{block}/edit', [SurgeryController::class, 'editSurgeryBlock'])->name('edit-direction-block');
        });

        Route::prefix('/main-page')->name('admin.main-page.')->group(function() {
            Route::get('/', [PageController::class, 'mainPage'])->name('show');
            Route::get('/edit-seo', [PageController::class, 'mainPageSeo'])->name('edit-seo');
            Route::get('/edit-block/{block}', [PageController::class, 'mainPageEdit'])->name('edit-block');

            Route::get('/create-slide/{page}', [PageController::class, 'createSlide'])->name('create-slide');
            Route::get('/edit-slide/{block}', [PageController::class, 'editSlide'])->name('edit-slide');
        });

        Route::get('/header', [PageController::class, 'editHeader'])->name('admin.header.edit');
        Route::get('/footer', [PageController::class, 'editFooter'])->name('admin.footer.edit');

        Route::get('/affiliate/create', [PageController::class, 'createFooterAffiliate'])->name('admin.footer.affiliate.create');
        Route::get('/affiliate/{affiliate}/edit', [PageController::class, 'editFooterAffiliate'])->name('admin.footer.affiliate.edit');

        Route::get('/affiliate/{city}/create', [PageController::class, 'createAffiliate'])->name('admin.affiliate.create');
        Route::get('/affiliate/{city}/{affiliate}/edit', [PageController::class, 'editAffiliate'])->name('admin.affiliate.edit');

        Route::get('/footer-links', [PageController::class, 'editFooterLinks'])->name('admin.footer.links.edit');

        Route::prefix('/vacancies')->name('admin.vacancies.')->group(function() {
            Route::get('/', [VacancyController::class, 'index'])->name('index');

            Route::get('/edit-main-seo', [VacancyController::class, 'mainPageSeo'])->name('edit-main-seo');
            // Route::get('/edit-one-page-seo', [VacancyController::class, 'onePageSeo'])->name('edit-one-page-seo');

            Route::get('/edit-block/{page}/{block}', [VacancyController::class, 'editBlock'])->name('edit-block');

            Route::get('/create', [VacancyController::class, 'create'])->name('create');
            Route::get('/{vacancy}/edit', [VacancyController::class, 'edit'])->name('edit');
        });

        Route::get('/edit-robots', [RobotsController::class, 'edit'])->name('admin.edit-robots');
    });

});
