<?php

use App\Http\Controllers\LookupController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SiteFormController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoiceToTextController;

Route::prefix('company')->group(function () {
    Route::get('/lookups', [LookupController::class, 'getLookupData']);
    Route::post('/add-form-data', [SiteFormController::class, 'addFormData']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/transcribe', [VoiceToTextController::class, 'transcribe']);

    Route::group(['middleware' => ['auth:user-api']], function () {
        Route::post('/logout',[UserController::class, 'logout']);
        Route::prefix('patients')->group( function () {
            Route::get('/', [PatientController::class, 'getPatients']);
            Route::get('/{id}', [PatientController::class, 'getDataOfPatientById']);
        });
    });
});
