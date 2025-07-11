<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckTaekwondoEnrollment
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return Inertia::render('Programs/Taekwondo/Index');
        }

        $user = auth()->user();
        $isEnrolled = $user->profile?->programs()
            ->whereTranslation('title', 'Taekwondo')
            ->exists();

        if (!$isEnrolled) {
            return Inertia::render('Programs/Taekwondo/Index');
        }

        return $next($request);
    }
}