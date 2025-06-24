<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Profile;

class ProfileRepository extends ModuleRepository
{

    protected $relatedBrowsers = ['program'];

    use HandleBlocks, HandleTranslations, HandleSlugs;
        public function __construct(Profile $model)
    {
        $this->model = $model;
    }
  public function afterSave(TwillModelContract $model, array $fields): void
    {
        $programsToSync = [];
        if (isset($fields['programs'])) {
            foreach ($fields['programs'] as $index => $programId) {
                // Assign a position based on the order they appear in the multiselect field
                $programsToSync[$programId] = ['position' => $index + 1];
            }
        }
        $model->programs()->sync($programsToSync);
        parent::afterSave($model, $fields);
    }



}
