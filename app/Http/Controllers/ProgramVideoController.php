<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProgramVideo;
use Illuminate\Http\Response; // <-- Keep this for abort_if
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth; // Added import
use Illuminate\Support\Facades\Redirect; // Added import
use Illuminate\Support\Str;

class ProgramVideoController extends Controller
{
    public function index(): InertiaResponse
    {
        $videos = Cache::rememberForever('program_videos', function () {
            return ProgramVideo::with('program')
                ->whereHas('program', function ($query) {
                    $query->publishedInListings();
                })
                ->get();
        });

        return Inertia::render('Programs/Taekwondo/Videos/Index', [
            'videos' => $videos,
        ]);
    }
}
