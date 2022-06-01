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
    Route::get('/readnotif', [App\Http\Controllers\Admin\NotificationController::class, 'readNotification']);

    Route::post('subevent/saveform', [App\Http\Controllers\Admin\SubeventController::class, 'saveForm']);
    Route::get('subevent/getform/{id}', [App\Http\Controllers\Admin\SubeventController::class, 'editForm']);
    Route::put('subevent/updateform/{id}', [App\Http\Controllers\Admin\SubeventController::class, 'updateForm']);

    Route::post('form', [App\Http\Controllers\Admin\SubeventController::class, 'getForm']);
    Route::post('responden', [App\Http\Controllers\Admin\SubeventController::class, 'getResponden']);
    Route::get('componentform/{id}', [App\Http\Controllers\Admin\SubeventController::class, 'getComponentForm']);

    Route::delete('form/{id}', [App\Http\Controllers\Admin\SubeventController::class, 'deleteForm']);
    Route::delete('deleteresponden/{identity}', [App\Http\Controllers\Admin\SubeventController::class, 'deleteResponden']);

    Route::get('/', [App\Http\Controllers\Admin\DashboradController::class, 'index']);
    Route::resource('screen', App\Http\Controllers\Admin\ScreenController::class);
    Route::post('screen/activate', [App\Http\Controllers\Admin\ScreenController::class, 'activatedScreen']);
    Route::resource('event', App\Http\Controllers\Admin\EventController::class);
    Route::resource('setting', App\Http\Controllers\Admin\SettingController::class);
    Route::resource('profile', App\Http\Controllers\Admin\ProfileController::class);
    Route::post('subevent/activate', [App\Http\Controllers\Admin\SubeventController::class, 'activateSubevent']);
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
Route::get('/event/{slug}', [App\Http\Controllers\Front\SubeventController::class, 'index']);
Route::get('/form/{slug}', [App\Http\Controllers\Front\SubeventController::class, 'form']);
Route::post('/sendform/{slug}', [App\Http\Controllers\Front\SubeventController::class, 'saveForm']);

Auth::routes();
