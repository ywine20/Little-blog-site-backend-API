<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiLikeController;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\ApiCommentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::apiResource(name:'posts',controller:ApiPostController::class);
Route::apiResource(name:'likes',controller:ApiLikeController::class);
Route::apiResource(name:'comments',controller:ApiCommentController::class);
