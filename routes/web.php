<?php

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

Route::get('/', [App\Http\Controllers\LandingController::class, 'index']);

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboradController::class, 'index']);
    Route::resource('screen', App\Http\Controllers\Admin\ScreenController::class);
    Route::post('screen/activate', [App\Http\Controllers\Admin\ScreenController::class, 'activatedScreen']);
    Route::resource('event', App\Http\Controllers\Admin\EventController::class);
    Route::resource('setting', App\Http\Controllers\Admin\SettingController::class);
    Route::resource('profile', App\Http\Controllers\Admin\ProfileController::class);

    Route::get('subevent/{event}', [App\Http\Controllers\Admin\SubeventController::class, 'index']);
    Route::post('subevent/{event}', [App\Http\Controllers\Admin\SubeventController::class, 'store']);
    Route::put('subevent/{event}/{id}', [App\Http\Controllers\Admin\SubeventController::class, 'update']);
    Route::delete('subevent/{event}/{id}', [App\Http\Controllers\Admin\SubeventController::class, 'destroy']);

    Route::get('subevent/{event}/{id}/edit', [App\Http\Controllers\Admin\SubeventController::class, 'edit']);

    // Route::get('', [App\Http\Controllers\Admin\EventController::class,'index']);
    // Route::resource('subevent/{}', App\Http\Controllers\Admin\EventController::class);

});

Route::group(['middleware' => 'peserta', 'prefix' => 'peserta'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();
