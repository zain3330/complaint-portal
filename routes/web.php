<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//
//Route::get('/', function () {
//    return view('complaint-registration');
//});
Route::get('/', [\App\Http\Controllers\Frontend\ComplaintController::class, 'index'])->name('complaint.index');
Route::post('/complaint/store', [\App\Http\Controllers\Frontend\ComplaintController::class, 'store'])->name('complaint.store');
Route::post('/complaint/send-verification-code', [\App\Http\Controllers\Frontend\ComplaintController::class, 'sendVerificationCode'])->name('complaint.sendVerificationCode');
Route::post('/complaint/verify-code', [\App\Http\Controllers\Frontend\ComplaintController::class, 'verifyCode'])->name('complaint.verifyCode');


Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
Route::get('/complaints', [\App\Http\Controllers\Admin\ComplaintController::class, 'index'])->name('complaints.index');
