<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CheckUpController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\DirectionsController;
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
//        'middleware' => ['admin_auth']
    ], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('adminDashboard');

        Route::prefix('/directions')->group(function() {
            Route::get('/', [DirectionsController::class, 'index'])->name('directions.index');
            Route::get('/{directionId}/edit', [DirectionsController::class, 'edit'])->name('directions.edit');
        });
        Route::prefix('/insurance-companies')->group(function() {
            Route::get('/', [InsuranceCompaniesController::class, 'index'])->name('insurance.companies.index');
        });

        Route::prefix('/promotions')->name('admin.promotions.')->group(function() {
            Route::get('/', [PromotionController::class, 'index'])->name('index');
            Route::get('/create', [PromotionController::class, 'create'])->name('create');
            Route::get('/{promotion}/edit', [PromotionController::class, 'edit'])->name('edit');
        });

        Route::prefix('/check-ups')->name('admin.check-ups.')->group(function() {
            Route::get('/', [CheckUpController::class, 'index'])->name('index');
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
            Route::get('/create', [ArticleController::class, 'create'])->name('create');
            Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
        });
    });

});
