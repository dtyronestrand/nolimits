<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log; // Add this
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TKDApplicationController;
use App\Http\Controllers\ProgramVideoController;
use Inertia\Inertia;



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
    Route::get("/programs/{taekwondo}/resources/terms", function(){
        return Inertia::render('Programs/Taekwondo/Resources/Terms');
    })->middleware('auth:sanctum');

    Route::get('/programs/taekwondo/history', function () {
        return Inertia::render('Programs/Taekwondo/History');
    });
    



Route::get('/programs/taekwondo', function () {
    return Inertia::render('Programs/Taekwondo/Members');
})->middleware('taekwondo.enrolled');
Route::get('/programs/taekwondo/application', [TKDApplicationController::class, 'create']);

Route::get('/programs/taekwondo/videos', [ProgramVideoController::class, 'index']);
    Route::get('/programs', [ProgramController::class, 'index']);

    Route::get('/programs/{slug}', [ProgramController::class, 'show'])
->where('slug','.*')
    ->name('program.show');



  Route::get('/news', [NewsController::class, 'index']);

    Route::get('/news/{slug}', [NewsController::class, 'show'])
->where('slug','.*')
    ->name('news.show');


Route::get('/{slug}', [PageController::class, 'show'])
->where('slug','.*')
    ->name('page.show');
Route::put('/profile/{profile}/requirements', [App\Http\Controllers\ProfileRequirementController::class, 'update'])->middleware('auth');
