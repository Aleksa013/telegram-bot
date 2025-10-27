<?php

use App\Http\Controllers\SiteController;
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

Route::get('menu/{type}',[SiteController::class, 'getProductList']);
Route::get('reviews',[SiteController::class, 'getReviews']);
Route::get('review/{review}',[SiteController::class, 'getReview']);
Route::get('user/{id}', [SiteController::class, 'getUser']);
