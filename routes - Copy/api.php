<?php

use App\Http\Controllers\EnumApiController;
use App\Http\Controllers\LoginApiController;
use App\Http\Controllers\RateApiController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\TransactionApiController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("v1")->group(
    function () {
        Route::prefix("/user")->group(function () {
            Route::post('/login', [LoginApiController::class, "login"]);
            Route::middleware('auth:api', 'isHanpass', 'signatureForUpdatePw', 'checkAGCAndPI')->post('/update_password', [UserController::class, 'resetPassword']);
        });

        Route::prefix("/transaction")->group(function () {
            Route::middleware('auth:api', 'isHanpass')->get('/index', [TransactionApiController::class, "index"]);
            // Route::middleware('auth:api', 'isHanpass')->get('/completeTransaction', [TransactionApiController::class, "completeTransaction"]);
            Route::middleware('auth:api', 'isHanpass','signatureForStoreTransaction', 'checkAGCAndPI')->post('/store', [TransactionApiController::class, "store"]);
            Route::middleware('auth:api', 'isHanpass', 'signatureForCommit', 'checkAGCAndPI')->post('/commitTransaction', [TransactionApiController::class, "commit"]);
            Route::middleware('auth:api', 'isHanpass', 'signatureForModify', 'checkAGCAndPI')->post('/modifyTransaction', [TransactionApiController::class, "update"]);
            Route::middleware('auth:api', 'isHanpass', 'signatureForCancel', 'checkAGCAndPI')->post('/cancelTransaction', [TransactionApiController::class, "cancel"]);
            Route::middleware('auth:api', 'isHanpass', 'signatureForCheckTransaction', 'checkAGCAndPI')->post('/checkTransaction', [TransactionApiController::class, "check"]);
        });

        Route::prefix("/transfertokorea")->group(function () {
            Route::middleware('auth:api', 'isHanpass')->get('/index', [TempController::class, "index"]);
        });

        // Route::prefix("/rate")->group(function () {
        //     Route::middleware('auth:api', 'isHanpass', 'signatureForRate')->post('/current_rate', [RateApiController::class, "currentRate"]);
        // });

        Route::prefix("/rate")->group(function () {
            Route::middleware('auth:api', 'isHanpass', 'signatureForRate' , 'checkAGCAndPI')->post('/current_rate', [RateApiController::class, "currentRate"]);
        });

        Route::middleware('auth:api', 'isHanpass', 'signatureForGetEnums', 'checkAGCAndPI')->post("/getEnums", [EnumApiController::class, "getEnums"]);
    }
);
