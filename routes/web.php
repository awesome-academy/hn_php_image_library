<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\HomeController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Auth::routes();

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('profile', ProfileController::class)->only([
        'update',
        'destroy',
    ]);
    Route::prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/delete', [ProfileController::class, 'delete'])->name('profile.delete');
        Route::get('/favorites', [ProfileController::class, 'favorites'])->name('profile.favorites');
        Route::get('/upload', [ProfileController::class, 'upload'])->name('profile.upload');
        Route::post('/upload-image', [PageController::class, 'saveUpload'])->name('image.upload');
    });
    Route::middleware(['role'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::group(['middleware' => 'categories'], function () {
            Route::resource('categories', CategoryController::class);
        });
        Route::group(['middleware' => 'subcategories'], function () {
            Route::resource('subcategories', SubcategoryController::class);
        });
        Route::group(['middleware' => 'images'], function () {
            Route::resource('images', ImageController::class)->only([
                'index',
                'destroy',
            ]);
        });
        Route::group(['middleware' => 'permissions'], function () {
            Route::resource('permissions', PermissionController::class)->only([
                'index',
            ]);
        });
        Route::group(['middleware' => 'roles'], function () {
            Route::resource('roles', RoleController::class);
        });
        Route::group(['middleware' => 'users'], function () {
            Route::resource('users', UserController::class);
        });
    });
    Route::prefix('image/{image}')->group(function () {
        Route::get('/edit', [PageController::class, 'editImage'])->name('image.editImage');
        Route::put('/update', [PageController::class, 'updateImage'])->name('image.updateImage');
        Route::delete('/delete', [PageController::class, 'deleteImage'])->name('image.deleteImage');
    });
});

Route::get('/search', [HomeController::class, 'search'])->name('home.search');
Route::get('/view-all/{type}', [HomeController::class, 'viewAll'])->name('home.viewall');

Route::prefix('category')->group(function () {
    Route::get('/', [HomeController::class, 'category'])->name('home.category');
    Route::get('/{slug}', [HomeController::class, 'subcategory'])->name('home.subcategory');
});

Route::prefix('image/{slug}')->group(function () {
    Route::get('/', [HomeController::class, 'image'])->name('home.image');
    Route::get('/download', [HomeController::class, 'download'])->name('image.download');
});
Route::get('/user/{id}', [HomeController::class, 'user'])->name('home.user');
