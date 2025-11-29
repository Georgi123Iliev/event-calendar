<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrganizerController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('locations', LocationController::class);
Route::get('/locations/{location}/appEvents', [LocationController::class, 'appEvents'])
     ->name('locations.appEvents');

     
Route::resource('organizers', OrganizerController::class);
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
