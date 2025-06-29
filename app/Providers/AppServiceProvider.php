<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\Services\Assets\Twill;
use A17\Twill\View\Components\Navigation\NavigationLink;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      TwillNavigation::addLink(
            NavigationLink::make()
            ->title(Str::ucfirst(__('content')))
            ->forSingleton('home')
            ->doNotAddSelfAsFirstChild()
            ->setChildren([
                NavigationLink::make()
                ->title(Str::ucfirst(__('home')))
                ->forSingleton('home'),
                NavigationLink::make()
                ->title(Str::ucfirst(__('pages')))
                ->forModule('page'),
                NavigationLink::make()
                ->title(Str::ucfirst(__('programs')))
                ->forModule('programs'),
            ])
            );
        TwillNavigation::addLink(
            NavigationLink::make()
            ->title(Str::ucfirst(__('navigation')))
            ->forModule('navigations')
        );
        TwillNavigation::addLink(
            NavigationLink::make()
            ->title(Str::ucfirst(__('profiles')))
            ->forModule('profiles')
        );
            Relation::enforceMorphMap([
                'home' => 'App\Models\Home',
                'navigation' => 'App\Models\Navigation',
                'page' => 'App\Models\Page',
                'program' => 'App\Models\Program',
                'profile' => 'App\Models\Profile',
                'programBelt' => 'App\Models\ProgramBelt',
          
            ]);
    }
}
