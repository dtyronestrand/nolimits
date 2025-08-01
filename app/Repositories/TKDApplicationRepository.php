<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use A17\Twill\Models\Contracts\TwillModelContract;
use App\Models\TKDApplication;
use App\Models\Profile;

class TKDApplicationRepository extends ModuleRepository
{
    use HandleFiles, HandleRevisions;

    public function __construct(TKDApplication $model)
    {
        $this->model = $model;
    }
    
    public function getFormFields(TwillModelContract $model): array
    {
        $fields = parent::getFormFields($model);
        
        // If model has a profile, populate fields from profile
        if ($model->profile_id && $model->profile) {
            $model->syncWithProfile();
        }
        
        return $fields;
    }
    
    public function afterSave(TwillModelContract $model, array $fields): void
    {
        // If profile_id is set, sync missing profile data from application
        if ($model->profile_id) {
            $model->updateProfileFromApplication();
        }
        
        parent::afterSave($model, $fields);
    }
}
