<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\Behaviors\HandleNesting;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Resource;

class ResourceRepository extends ModuleRepository
{
    use HandleBlocks, HandleSlugs, HandleRevisions, HandleNesting;

    public function __construct(Resource $model)
    {
        $this->model = $model;
    }
}
