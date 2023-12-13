<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SendingController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
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



Auth::routes();



Route::middleware(["auth", "isAdmin"])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class,'index']);
    Route::resource('/transactions',TransactionController::class)->middleware("isAdmin");
    Route::get('/today_transactions',[TransactionController::class,'todayIndex'])->name('transaction.todayIndex');
    Route::get('/today_uncomplete_transactions', [TransactionController::class, 'todayUncompleteIndex'])->name('transaction.todayUncompleteIndex');
    Route::get('/today_complete_transactions', [TransactionController::class, 'todayCompleteIndex'])->name('transaction.todayCompleteIndex');
    Route::get('/uncomplete_transactions', [TransactionController::class, 'uncompleteIndex'])->name('transaction.uncompleteIndex');
    Route::get('/complete_transactions', [TransactionController::class, 'completeIndex'])->name('transaction.completeIndex');

    //shearch
    Route::get('/searchByDateShow', [TransactionController::class, 'searchByDateShow'])->name('transaction.searchByDateShow');
    Route::post('/searchByDate', [TransactionController::class, 'searchByDate'])->name('transaction.searchByDate');
    Route::get('/searchTrNumber', [TransactionController::class, 'searchTrNumber'])->name('transaction.searchTrNumber');

    Route::resource('/transfer', SendingController::class);
    Route::get('/transfer/sign', [SendingController::class, 'signIndex'])->name('sending.signIndex');

    //Temp
    Route::resource('/temp', TempController::class);

    //Rate
    Route::resource('/rate', RateController::class);

    Route::get('/downloadbydate', [TransactionController::class, 'downloadbydate'])->name('download.downloadbydate');
    Route::post('/transactions/export', [TransactionController::class, 'export'])->name('download.export');

});


// Route::get('/transactions/export', [TransactionController::class, 'export']);

