<?php


use Illuminate\Http\Request;
use App\Models\ApiShareController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
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

Route::post('/register',[ApiAuthController::class,'register'])->name('api.register');
Route::post('/login',[ApiAuthController::class,'login'])->name('api.login');
// Route::get('/user/searchs',[ApiUserSearch::class,'filter'])->name('usersearchs');


Route::middleware('auth:sanctum')->group(function(){

    Route::get('/logout',[ApiAuthController::class,'logout'])->name('api.logout');
    Route::get('/logout-all',[ApiAuthController::class,'logoutAll'])->name('api.logoutAll');
    Route::get('/tokens',[ApiAuthController::class,'tokens'])->name('api.tokens');

    Route::apiResource(name:'posts',controller:ApiPostController::class);
    Route::apiResource(name:'likes',controller:ApiLikeController::class);
    Route::apiResource(name:'comments',controller:ApiCommentController::class);
    Route::apiResource(name:'shares',controller:ApiShareController::class);

    });
