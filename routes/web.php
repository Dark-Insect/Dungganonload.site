<?php
use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\MemberReminderController;
use App\Http\Controllers\member\MemberController;
use App\Http\Controllers\admin\LoanRequestController;
use App\Http\Controllers\member\LoanController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/template', function () {
    return view('email.MemberEmailViewTemplate');
});

// ADMIN DASHBOARD
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('/members', AdminController::class,['names' => 'member']);
    Route::resource('/loan-request', LoanRequestController::class,['names' => 'loan-request']);
    Route::get('notifications', [MemberReminderController::class,'index'])->name('notifications');
    Route::put('notifications/update', [MemberReminderController::class,'setSetting'])->name('notifications.update');

    // Loan Review
    Route::get('loan-review/{id}',[LoanRequestController::class,'ReviewLoanRequest'])->name('loan-review');
});

// MEMBER DASHBOARD
Route::prefix('member')->name('member.')->middleware('auth')->group(function () {
    Route::resource('/notifications', MemberController::class,['names' => 'mail']);
    Route::resource('/loan', LoanController::class,['names' => 'loan']);

    // PUT
    Route::put('loan-request', [LoanController::class,'LoanRequest'])->name('loan-request');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
