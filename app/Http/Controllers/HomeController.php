<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class HomeController extends Controller
{
    public function __invoke(): InertiaResponse
    {
        $locale = app()->getLocale();

        $item = Cache::rememberForever(
            'home.' . $locale,
            function () {
                $item = Home::first();

                if ($item !== null) {
                    $item->load('translations', 'blocks');
                    $item->computeBlocks();
                }

                return $item;
            }
        );

        abort_if($item === null, Response::HTTP_NOT_FOUND);

        return Inertia::render('Home', [
            'item' => $item->only($item->publicAttributes),
            'locale' => $locale,
        ]);
    }
}
