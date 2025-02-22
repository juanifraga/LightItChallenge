<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/patients', [PatientController::class, 'index']);

Route::post('/patients', [PatientController::class, 'store']);

Route::delete('/patients/{id}', [PatientController::class, 'destroy']);