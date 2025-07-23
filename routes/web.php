<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\KaryawanAuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Inertia::render('Beranda');
});

Route::get('/survey-form', function () {
    return Inertia::render('SurveyForm');
});

Route::get('/karyawan', function () {
    return Inertia::render('LoginKaryawan');
});

Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

require __DIR__.'/auth.php';
