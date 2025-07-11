<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => function () use ($request) {
                    if (! $request->user()) {
                        return null;
                    }

                    $user = $request->user()->load('profile.programs.programBelts');
                    
                    if ($user->profile && $user->profile->current_belt) {
                        $user->profile->current_belt_data = \App\Models\ProgramBelt::select('*')->find($user->profile->current_belt);
                    }
                    
                    return $user;
                },
            ],
            'navigations' => \App\Models\Navigation::published()->get(),
        ];
    }

    
}
