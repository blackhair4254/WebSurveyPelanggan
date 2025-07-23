<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SurveyController;
use App\Http\Controllers\KaryawanAuthController;

Route::post('/survey', [SurveyController::class, 'store']);
Route::get('/survey', [SurveyController::class, 'index']);


Route::post('/karyawan/login', [KaryawanAuthController::class, 'login']);
Route::get('/survey/summary', [SurveyController::class, 'summary']);
Route::put('/survey/{survey}', [SurveyController::class, 'update']);
Route::delete('/survey/{survey}', [SurveyController::class, 'destroy']);
