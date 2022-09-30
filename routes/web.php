<?php

use App\Http\Controllers\Administrator\AdministratorDashboardController;
use App\Http\Controllers\Administrator\SettingsController;
use App\Http\Controllers\Administrator\UserRegisteredController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserProofController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/register_user',[RegisterUserController::class, 'registerUser'])->name('register_user');

Route::group(['prefix'  => 'administrator'],function(){
    Route::get('/dashboard',[AdministratorDashboardController::class, 'dashboard'])->name('administrator.dashboard');

    Route::group(['prefix' => '/user_registered'], function(){
        Route::get('/',[UserRegisteredController::class, 'index'])->name('administrator.user');
        Route::patch('/{id}/update',[UserRegisteredController::class, 'update'])->name('administrator.user.update');
        Route::patch('/change_password',[UserRegisteredController::class, 'changePassword'])->name('administrator.user.change_password');
        Route::patch('{id}/set_non_active',[UserRegisteredController::class, 'setNonAktive'])->name('administrator.user.set_non_active');
        Route::patch('{id}/set_active',[UserRegisteredController::class, 'setAktive'])->name('administrator.user.set_active');
        Route::get('{id}/detail',[UserRegisteredController::class, 'detail'])->name('administrator.user.detail');
    });

    Route::group(['prefix' => '/settings'], function(){
        Route::get('/',[SettingsController::class, 'index'])->name('administrator.settings');
        Route::patch('/{id}/update',[SettingsController::class, 'update'])->name('administrator.settings.update');
    });
});

Route::group(['prefix'  => 'user'],function(){
    Route::get('/dashboard',[UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::patch('/change_password',[UserDashboardController::class, 'changePassword'])->name('user.change_password');
    Route::patch('/{id}/profile_update',[UserDashboardController::class, 'profileUpdate'])->name('user.profile_update');
});

Route::group(['prefix'  => 'user'],function(){
    Route::get('/bukti_pembayaran',[UserProofController::class, 'index'])->name('user.proof');
    Route::patch('/{id}/proof_update',[UserProofController::class, 'proofUpdate'])->name('user.proof_update');

});

Auth::routes();
