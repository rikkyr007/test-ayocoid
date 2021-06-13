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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('teams', App\Http\Controllers\TeamController::class);
    Route::resource('players', App\Http\Controllers\PlayerController::class)->except(['index']);
    Route::resource('schedules', App\Http\Controllers\ScheduleController::class);
    Route::post('/schedules/updateScore', [App\Http\Controllers\ScheduleController::class, 'updateScore'])->name('schedule.updateScore');

    Route::group(['prefix' => '/schedules/details'], function () {
        Route::get('/show/{id}', [App\Http\Controllers\ScheduleController::class, 'detailIndex'])->name('schedule.details');
        Route::get('/create/{id}', [App\Http\Controllers\ScheduleController::class, 'detailCreate'])->name('scheduleDetail.create');
        Route::post('/getPlayer', [App\Http\Controllers\ScheduleController::class, 'getPlayer'])->name('scheduleDetail.getPlayer');
        Route::post('/store', [App\Http\Controllers\ScheduleController::class, 'detailStore'])->name('scheduleDetail.store');
        Route::delete('/destroy/{id}', [App\Http\Controllers\ScheduleController::class, 'detailDestroy'])->name('scheduleDetail.destroy');
    });
});

Route::name('js.')->group(function () {
    Route::get('/dynamic.js', [App\Http\Controllers\JsController::class, 'dynamic'])->name('dynamic');
});
