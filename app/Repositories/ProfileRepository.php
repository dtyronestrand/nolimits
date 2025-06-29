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
    public function getFormFields(TwillModelContract $model): array
    {
        $fields = parent::getFormFields($model);
        
        // Set checkbox values based on existing program relationships
        $selectedPrograms = $model->programs->pluck('id')->toArray();
        foreach (\App\Models\Program::all() as $program) {
            $fields['programs_' . $program->id] = in_array($program->id, $selectedPrograms);
        }
        
        return $fields;
    }

    public function afterSave(TwillModelContract $model, array $fields): void
    {
        $programsToSync = [];
        $position = 1;
        
        // Check each checkbox field and collect selected programs
        foreach (\App\Models\Program::all() as $program) {
            $checkboxName = 'programs_' . $program->id;
            if (isset($fields[$checkboxName]) && $fields[$checkboxName]) {
                $programsToSync[$program->id] = ['position' => $position++];
            }
        }
        
        $model->programs()->sync($programsToSync);
        parent::afterSave($model, $fields);
    }



}
