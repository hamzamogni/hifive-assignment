<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductController;
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

Route::get("/products/{product}/categories", [ProductCategoriesController::class, "index"]);
Route::post("/products/{product}/categories/{category}", [ProductCategoriesController::class, "store"]);
Route::delete("/products/{product}/categories/{category}", [ProductCategoriesController::class, "destroy"]);

Route::apiResources([
    "categories" => CategoryController::class,
    "products" => ProductController::class,
]);
