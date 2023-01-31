<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;

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

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('account', [UserAccountController::class, 'show'])->name('account');
    Route::get('update-account', [UserAccountController::class, 'create'])->name('update-account-form');
    Route::post('update-account', [UserAccountController::class, 'store'])->name('update-account');
    
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});