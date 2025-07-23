<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log; // Add this
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProgramVideoController;
use Inertia\Inertia;


Route::get('/welcome' , function(){
    return Inertia::render('Welcome');
});

Route::get('/auth-check', function() {
    return ['authenticated' => auth()->check(), 'user' => auth()->user()];
});

Route::get('/debug-login', function() {
    return [
        'session_driver' => config('session.driver'),
        'session_domain' => config('session.domain'),
        'session_secure' => config('session.secure'),
        'sanctum_stateful' => config('sanctum.stateful'),
        'app_url' => config('app.url'),
        'request_url' => request()->url(),
        'request_host' => request()->getHost(),
        'request_port' => request()->getPort(),
        'cookies' => request()->cookies->all()
    ];
});

Route::post('/test-login', function(\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
 
    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return ['success' => true, 'user' => auth()->user()];
    }
 
    return ['success' => false, 'message' => 'Invalid credentials'];
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
    Route::get("/programs/{taekwondo}/resources/terms", function(){
        return Inertia::render('Programs/Taekwondo/Resources/Terms');
    })->middleware('auth:sanctum');
    
Route::get('/programs/taekwondo', function () {
    return Inertia::render('Programs/Taekwondo/Members');
})->middleware('taekwondo.enrolled');

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