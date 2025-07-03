<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log; // Add this
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProgramController;
use Inertia\Inertia;


Route::get('/welcome' , function(){
    return Inertia::render('Welcome');
});

Route::get('/', HomeController::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
    Route::get('/programs', [ProgramController::class, 'index']);

    Route::get('/programs/{slug}', [ProgramController::class, 'show'])
->where('slug','.*')
    ->name('program.show');

Route::get('/{slug}', [PageController::class, 'show'])
->where('slug','.*')
    ->name('page.show');
