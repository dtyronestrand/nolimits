<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\ModuleRepository;
use A17\Twill\Repositories\Behaviors\HandleJsonRepeaters;
use App\Models\Navigation;

class NavigationRepository extends ModuleRepository
{
    use HandleTranslations, HandleJsonRepeaters;
protected $jsonRepeaters = [
        'submenu',
    ];
    public function __construct(Navigation $model)
    {
        $this->model = $model;
    }
}
