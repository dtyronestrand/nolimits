<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\ModuleRepository;
use A17\Twill\Repositories\Behaviors\HandleJsonRepeaters;
use App\Models\ProgramBelt;

class ProgramBeltRepository extends ModuleRepository
{
    use HandleBlocks, HandleJsonRepeaters,HandleSlugs;
protected $jsonRepeaters = [
    'requirements',
];
    public function __construct(ProgramBelt $model)
    {
        $this->model = $model;
    }
}
