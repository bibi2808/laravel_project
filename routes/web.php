<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\HomeController;
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
$prefixNews = config("zvn.url.prefix_news"); // hot-news


// ============================================ SLIDER ==========================================
Route::prefix($prefixAdmin)->group(function () {

    $prefix = "slider";
    $controllerName = "slider";
    
    Route::prefix($prefix)->group(function () use($controllerName){

        Route::get('/',                             [SliderController::class, 'index'])->name($controllerName);
        Route::get('form/{id?}',                    [SliderController::class, 'form'])->name($controllerName . '/form')->where('id', '[0-9]+');
        Route::post('save',                         [SliderController::class, 'save'])->name($controllerName . '/save');
        Route::get('delete/{id}',                   [SliderController::class, 'delete'])->name($controllerName . '/delete')->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   [SliderController::class, 'status'])->name($controllerName . '/status')->where(['id' => '[0-9]+', 'status' => '[a-z]+']);

        
    });
    
});

// ============================================ CATEGORY ==========================================
Route::prefix($prefixAdmin)->group(function () {

    $prefix = "category";
    $controllerName = "category";
    
    Route::prefix($prefix)->group(function () use($controllerName){

        Route::get('/',                             [CategoryController::class, 'index'])->name($controllerName);
        Route::get('form/{id?}',                    [CategoryController::class, 'form'])->name($controllerName . '/form')->where('id', '[0-9]+');
        Route::post('save',                         [CategoryController::class, 'save'])->name($controllerName . '/save');
        Route::get('delete/{id}',                   [CategoryController::class, 'delete'])->name($controllerName . '/delete')->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   [CategoryController::class, 'status'])->name($controllerName . '/status')->where(['id' => '[0-9]+', 'status' => '[a-z]+']);

        Route::get('change-is-home-{isHome}/{id}',   [CategoryController::class, 'isHome'])->name($controllerName . '/isHome')->where(['id' => '[0-9]+', 'isHome' => '[a-z]+']);
    });
    
});


// ============================================ HOME PAGE ==========================================
Route::prefix($prefixNews)->group(function () {

    $prefix = "";
    $controllerName = "home";
    
    Route::prefix($prefix)->group(function () use($controllerName){

        Route::get('/', [HomeController::class, 'index'])->name($controllerName);
    
    });
    
});


// ============================================ DASHBOARD ==========================================
Route::prefix($prefixAdmin)->group(function () {

    $prefix = "dashboard";
    $controllerName = "dashboard";

    Route::prefix($prefix)->group(function () use($controllerName){
        Route::get('/', [DashboardController::class, 'index'])->name($controllerName);
    });
    
});

