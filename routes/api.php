<?php

use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\FollowApiController;
use App\Http\Controllers\API\ImageApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('image/{slug}')->group(function () {
        Route::post('/like', [ImageApiController::class, 'updateLike'])->name('image.like');
        Route::post('/share', [ImageApiController::class, 'updateShare'])->name('image.share');
        Route::post('/comment', [ImageApiController::class, 'comment'])->name('image.comment');
    });
    Route::prefix('user/{id}')->group(function () {
        Route::post('/follow', [FollowApiController::class, 'updateFollow'])->name('profile.follow');
    });
});

Route::post('subcategory', [CategoryApiController::class, 'getSubcategory'])->name('subcategory');
Route::get('/search', [ImageApiController::class, 'homeSearch'])->name('image.homeSearch');
