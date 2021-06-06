<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\News\HomeController as NewsHomeController;
use App\Http\Controllers\News\CategoryController as NewsCategoryController;
use App\Http\Controllers\News\ArticleController as NewsArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$prefixAdmin = config("zvn.url.prefix_admin"); // admin
$prefixNews = config("zvn.url.prefix_news"); // hot-new


// ============================================ SLIDER ==========================================
Route::prefix($prefixAdmin)->group(function () {

    $prefix = "slider";
    $controllerName = "slider";
    
    Route::prefix($prefix)->group(function () use($controllerName){

        Route::get('/',                             [AdminSliderController::class, 'index'])->name($controllerName);
        Route::get('form/{id?}',                    [AdminSliderController::class, 'form'])->name($controllerName . '/form')->where('id', '[0-9]+');
        Route::post('save',                         [AdminSliderController::class, 'save'])->name($controllerName . '/save');
        Route::get('delete/{id}',                   [AdminSliderController::class, 'delete'])->name($controllerName . '/delete')->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   [AdminSliderController::class, 'status'])->name($controllerName . '/status')->where(['id' => '[0-9]+', 'status' => '[a-z]+']);
    });
    
});

// ============================================ ARTICLE ==========================================
Route::prefix($prefixAdmin)->group(function () {

    $prefix = "article";
    $controllerName = "article";
    
    Route::prefix($prefix)->group(function () use($controllerName){

        Route::get('/',                             [AdminArticleController::class, 'index'])->name($controllerName);
        Route::get('form/{id?}',                    [AdminArticleController::class, 'form'])->name($controllerName . '/form')->where('id', '[0-9]+');
        Route::post('save',                         [AdminArticleController::class, 'save'])->name($controllerName . '/save');
        Route::get('delete/{id}',                   [AdminArticleController::class, 'delete'])->name($controllerName . '/delete')->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   [AdminArticleController::class, 'status'])->name($controllerName . '/status')->where(['id' => '[0-9]+', 'status' => '[a-z]+']);
        Route::get('change-type-{type}/{id}',       [AdminArticleController::class, 'type'])->name($controllerName . '/type')->where(['id' => '[0-9]+']);
    });
    
});

// ============================================ CATEGORY ==========================================
Route::prefix($prefixAdmin)->group(function () {

    $prefix = "category";
    $controllerName = "category";
    
    Route::prefix($prefix)->group(function () use($controllerName){

        Route::get('/',                             [AdminCategoryController::class, 'index'])->name($controllerName);
        Route::get('form/{id?}',                    [AdminCategoryController::class, 'form'])->name($controllerName .    '/form')->where('id', '[0-9]+');
        Route::post('save',                         [AdminCategoryController::class, 'save'])->name($controllerName .    '/save');
        Route::get('delete/{id}',                   [AdminCategoryController::class, 'delete'])->name($controllerName .  '/delete')->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   [AdminCategoryController::class, 'status'])->name($controllerName .  '/status')->where(['id' => '[0-9]+']);
        Route::get('change-is-home-{isHome}/{id}',  [AdminCategoryController::class, 'isHome'])->name($controllerName .  '/isHome')->where(['id' => '[0-9]+']);
        Route::get('change-display-{display}/{id}', [AdminCategoryController::class, 'display'])->name($controllerName . '/display')->where(['id' => '[0-9]+']);
    });
    
});

// ============================================ DASHBOARD ==========================================
Route::prefix($prefixAdmin)->group(function () {

    $prefix = "dashboard";
    $controllerName = "dashboard";
    Route::prefix($prefix)->group(function () use($controllerName){
        Route::get('/', [AdminDashboardController::class, 'index'])->name($controllerName);
    });
    
});


Route::prefix($prefixNews)->group(function () {
    // ============================================ HOME PAGE ==========================================
    $prefix = "";
    $controllerName = "home";
    Route::prefix($prefix)->group(function () use($controllerName){
        Route::get('/', [NewsHomeController::class, 'index'])->name($controllerName);
    });

    // ============================================ CATEGORY ==========================================
    $prefix = "category";
    $controllerName = "category";
    Route::prefix($prefix)->group(function () use($controllerName){
        Route::get('/{category_name}-{category_id}.html', [NewsCategoryController::class, 'index'])->name($controllerName . '/index')
        ->where('category_name', '[0-9a-zA-Z_-]+')
        ->where('category_id', '[0-9]+');
    });

    // ============================================ POST DETAIL ==========================================
    $prefix = "post-detail";
    $controllerName = "article";
    Route::prefix($prefix)->group(function () use($controllerName){
        Route::get('/{article_name}-{article_id}.html', [NewsArticleController::class, 'index'])->name($controllerName . '/index')
        ->where('article_name', '[0-9a-zA-Z_-]+')
        ->where('article_id', '[0-9]+');
    });
    
});