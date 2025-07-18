<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Home;

class HomeRepository extends ModuleRepository
{
    use HandleBlocks, HandleTranslations, HandleRevisions;

    public function __construct(Home $model)
    {
        $this->model = $model;
    }
}
