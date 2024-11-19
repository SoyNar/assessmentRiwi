<?php

use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\MedicalSheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->get('/medical_schedule', [MedicalSheduleController::class, 'index']);
Route::resource('medical_schedule', MedicalSheduleController::class);

Route::resource('/appointments',AppointmentsController::class);
//Route::get('/appointments/create', [AppointmentsController::class, 'create'])->name('appointments.create');
//Route::post('/appointments', [AppointmentsController::class, 'store'])->name('appointments.store');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
