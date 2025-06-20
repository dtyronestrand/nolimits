<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Profile;

class ProfileRepository extends ModuleRepository
{
    use HandleBlocks, HandleTranslations, HandleSlugs;

    public function __construct(Profile $model)
    {
        $this->model = $model;
    }
}
