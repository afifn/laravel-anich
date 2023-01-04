<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\SubCategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->prefix('admin')->group(function () {
    Route::get('/login', 'index')->name('admin.login');
    Route::post('/login', 'authentication')->name('admin.auth');
    Route::get('/logout', 'logout')->name('admin.logout');
});

Route::middleware('admin.auth')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('/', 'index')->name('admin.category');
        Route::post('/store', 'store')->name('admin.category.store');
        Route::post('/update/{id}', 'update')->name('admin.category.update');
        Route::delete('/delete/{id}',  'destroy')->name('admin.category.delete');
    });
    Route::controller(SubCategoryController::class)->prefix('subcategory')->group(function () {
        Route::get('/', 'index')->name('admin.subcategory');
        Route::post('/store', 'store')->name('admin.subcategory.store');
        Route::post('/update/{id}', 'update')->name('admin.subcategory.update');
        Route::delete('/delete/{id}', 'destroy')->name('admin.subcategory.delete');
    });

    Route::controller(ItemController::class)->prefix('item')->group(function () {
        Route::get('/', 'index')->name('admin.item');
        Route::get('/create-item', 'itemCreate')->name('admin.item.create');
        Route::get('/update-item', 'itemUpdate')->name('admin.item.edit');
        Route::post('/store', 'store')->name('admin.item.store');
        Route::post('/update/{id}', 'updates')->name('admin.item.update');
        Route::delete('/delete/{id}', 'destroy')->name('admin.item.delete');
        Route::get('/ajax-subcat/{id}', 'ajax')->name('subcategory.ajax');
    });

    Route::controller(GenreController::class)->prefix('genre')->group(function () {
        Route::get('/', 'index')->name('admin.genre');
        Route::post('/store', 'store')->name('admin.genre.store');
        Route::post('/update/{id}', 'updates')->name('admin.genre.update');
        Route::delete('/delete/{id}', 'destroy')->name('admin.genre.delete');
    });

    Route::controller(StatusController::class)->prefix('status')->group(function () {
        Route::get('/', 'index')->name('admin.status');
        Route::post('/store', 'store')->name('admin.status.store');
        Route::post('/update/{id}', 'update')->name('admin.status.update');
        Route::delete('/delete/{id}', 'destroy')->name('admin.status.delete');
    });
});
