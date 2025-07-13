<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\Behaviors\HandleNesting;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\WebsiteGuide;

class WebsiteGuideRepository extends ModuleRepository
{
    use HandleSlugs, HandleRevisions, HandleNesting;

    public function __construct(WebsiteGuide $model)
    {
        $this->model = $model;
    }
}
