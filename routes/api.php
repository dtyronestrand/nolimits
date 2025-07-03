<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/profile/{id}', function ($id) {
    $profile = \App\Models\Profile::find($id);
    return $profile ? $profile->only($profile->publicAttributes ?? ['id', 'name', 'current_belt_name']) : null;
});
