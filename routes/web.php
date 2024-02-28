<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

//Frontend
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::post('enroll', [FrontendController::class, 'enroll'])->name('enroll');

//Admin Panel
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth', 'as' => 'dashboard.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('enroll/edit/{enroll}', [DashboardController::class, 'enroll_edit'])->name('enroll.edit');
    Route::post('enroll/update', [DashboardController::class, 'enroll_update'])->name('enroll.update');
    Route::get('enroll/delete/{enroll}', [DashboardController::class, 'enroll_delete'])->name('enroll.delete');

    //users management
    Route::get('users', [UsersController::class, 'index'])->name('users');
    Route::get('profile', [UsersController::class, 'user_profile'])->name('users.profile');
    Route::get('users/{id}', [UsersController::class, 'user_show'])->name('users.show');
    Route::post('users/add', [UsersController::class, 'user_add'])->name('users.add');
    Route::post('users/update/info', [UsersController::class, 'user_update_info'])->name('users.update.info');
    Route::post('users/update/password', [UsersController::class, 'user_update_password'])->name('users.update.password');
    Route::post('users/update/pro_pic', [UsersController::class, 'user_update_pro_pic'])->name('users.update.pro.pic');
    Route::get('users/delete/{id}', [UsersController::class, 'user_delete'])->name('users.delete');

    //settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'settings_update'])->name('settings.update');

    //debug
    Route::get('debug', [HomeController::class, 'debug']);
});
