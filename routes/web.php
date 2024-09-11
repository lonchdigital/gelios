<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CheckUpController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function () {

        Route::get('/', [HomeController::class, 'index'])->name('main');

        Route::get('/akczii-i-speczialnye-predlozheniya/', [PromotionController::class, 'index'])->name('promotions.index');
        Route::get('/akczii-i-speczialnye-predlozheniya/{promotion:slug}', [PromotionController::class, 'show'])->name('promotions.show');

        Route::get('/check-up/', [CheckUpController::class, 'index'])->name('check-ups.index');

        Route::get('/dlya-paczientov/', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('/dlya-paczientov/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

        Route::get('/nashi-speczialisty/', [DoctorController::class, 'index'])->name('doctors.index');
        Route::get('/nashi-speczialisty/{doctor:slug}', [DoctorController::class, 'show'])->name('doctors.show');
});

Route::get('lang/{lang}', [LanguageController::class, 'changeLanguage'])->name('changeLanguage');
