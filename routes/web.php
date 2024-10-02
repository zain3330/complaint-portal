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


Route::middleware('guest')->group(function () {
    // Login routes for guests only
    Route::get('/login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'index'])->name('login-screen');
    Route::post('/login', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'login'])->name('login');

});

Route::get('/', [\App\Http\Controllers\Frontend\ComplaintController::class, 'index'])->name('complaint.index');
Route::get('/complaint-register', [\App\Http\Controllers\Frontend\ComplaintController::class, 'register'])->name('complaint.register');
Route::post('/complaint/store', [\App\Http\Controllers\Frontend\ComplaintController::class, 'store'])->name('complaint.store');
Route::post('/complaint/send-verification-code', [\App\Http\Controllers\Frontend\ComplaintController::class, 'sendVerificationCode'])->name('complaint.sendVerificationCode');
Route::post('/complaint/verify-code', [\App\Http\Controllers\Frontend\ComplaintController::class, 'verifyCode'])->name('complaint.verifyCode');


Route::middleware(['isAuthenticated'])->group(function () {
Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
Route::get('/complaints', [\App\Http\Controllers\Admin\ComplaintController::class, 'index'])->name('complaints.index');
Route::get('/complaint/{complaint}', [\App\Http\Controllers\Admin\ComplaintController::class, 'show'])->name('complaint.view');
Route::get('/complaints/filter', [\App\Http\Controllers\Admin\ComplaintController::class, 'filterComplaints'])->name('complaints.filter');

Route::post('/complaints-updateStatus', [\App\Http\Controllers\Admin\ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
    Route::get('/complaints/get-users', [\App\Http\Controllers\Admin\ComplaintController::class, 'getUsers'])->name('complaints.getUsers');
    Route::post('/complaints/forward', [\App\Http\Controllers\Admin\ComplaintController::class, 'forwardComplaint'])->name('complaints.forward');


//roles
Route::resource('/role', \App\Http\Controllers\Admin\Role\RoleController::class);
Route::get('/create-role', [\App\Http\Controllers\Admin\Role\RoleController::class,'create'])->name('create-role');

//departments
Route::resource('/department', \App\Http\Controllers\Admin\Department\DepartmentController::class);
Route::get('/create-department', [\App\Http\Controllers\Admin\Department\DepartmentController::class,'create'])->name('create-department');

//users
Route::resource('/users', \App\Http\Controllers\Admin\User\UserController::class);
Route::get('/get-user', [\App\Http\Controllers\Admin\User\UserController::class, 'create'])->name('get-user');

//logout

    Route::post('/logout', [\App\Http\Controllers\Admin\Auth\AuthController::class, 'logout'])->name('logout');


});
