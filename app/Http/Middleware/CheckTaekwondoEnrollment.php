<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Program;
use Illuminate\Support\Facades\App;

class CheckTaekwondoEnrollment
{
    public function handle(Request $request, Closure $next)
    {
        $taekwondoProgram = Program::publishedInListings()
            ->whereTranslation('title', 'Taekwondo')
            ->first();

        if ($taekwondoProgram) {
            $taekwondoProgram->load('medias', 'blocks');
            $taekwondoProgram->computeBlocks(null, false, App::getLocale());
        }

        if (!auth()->check()) {
            return Inertia::render('Programs/Taekwondo/Index', [
                'item' => $taekwondoProgram?->only($taekwondoProgram->publicAttributes)
            ]);
        }

        $user = auth()->user();
        $isEnrolled = $user->profile?->programs()
            ->whereTranslation('title', 'Taekwondo')
            ->exists();

        if (!$isEnrolled) {
            return Inertia::render('Programs/Taekwondo/Index', [
                'item' => $taekwondoProgram?->only($taekwondoProgram->publicAttributes)
            ]);
        }

        return $next($request);
    }
}