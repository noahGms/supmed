<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [App\Http\Controllers\PatientController::class, 'store'])->name('register');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
        Route::get('/whoami', [\App\Http\Controllers\AuthController::class, 'whoami'])->name('whoami');
        Route::post('/whoami', [\App\Http\Controllers\AuthController::class, 'update'])->name('updateMyProfile');
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('/doctors/{doctor}/workstimes', \App\Http\Controllers\WorkstimeController::class);
});

Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::apiResource('doctors', \App\Http\Controllers\DoctorController::class);
    Route::apiResource('patients', \App\Http\Controllers\PatientController::class);
    Route::apiResource('admins', \App\Http\Controllers\AdminController::class);
    Route::apiResource('specialities', \App\Http\Controllers\SpecialityController::class);
    Route::apiResource('keywords', \App\Http\Controllers\KeywordController::class);
    Route::apiResource('appointmentsTypes', \App\Http\Controllers\AppointmentsTypeController::class);
    Route::apiResource('appointments', \App\Http\Controllers\AppointmentController::class);
});
