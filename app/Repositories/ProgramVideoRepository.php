<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleNesting;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\ProgramVideo;

class ProgramVideoRepository extends ModuleRepository
{
    use HandleSlugs, HandleNesting;

    public function __construct(ProgramVideo $model)
    {
        $this->model = $model;
    }
}
