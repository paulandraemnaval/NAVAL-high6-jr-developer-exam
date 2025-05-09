<?php

use App\Http\Controllers\AwarenessReportController;
use App\Http\Controllers\BrgyController;
use App\Http\Controllers\CheckStatusController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VirusReportController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CityController;

Route::get('/', function (){ return view('app');} )->name('index');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::resource('cities', CityController::class);
Route::resource('brgys', BrgyController::class);
Route::resource('patients', PatientController::class);

Route::get('/cities/{cityid}/brgys', [CityController::class,'get_brgys'])->name('cities.brgys');

Route::get('/awarenessreports', [AwarenessReportController::class,'index'])->name('awarenessreports.index');
Route::get('/awarenessreports/generate/{cityId}/{brgyId?}', [AwarenessReportController::class,'generate'])->name('awarenessreports.generate');

Route::get('virusreports/', [VirusReportController::class, 'index'])->name('virusreports.index');
Route::get('virusreports/generate/{cityId}/{brgyId?}', [VirusReportController::class, 'generate'])->name('virusreports.generate');

Route::get('checkstatus/', [CheckStatusController::class,'index'])->name('checkstatus.index');
Route::get('checkstatus/{number}', [CheckStatusController::class, 'check'])->name('ckeckstatus.check');



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
