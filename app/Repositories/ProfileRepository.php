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
        // Set requirements checkbox values from stored progress
        if ($model->current_belt && $model->requirements_progress) {
            foreach ($model->requirements_progress as $reqId => $progress) {
                $fields['requirements_' . $reqId . '_completed'] = $progress['completed'] ?? false;
            }
        }
        return $fields;
    }

    public function afterSave(TwillModelContract $model, array $fields): void
    {
        $programsToSync = [];
        $position = 1;
        $selected = [];
        // Check each checkbox field and collect selected programs
        foreach (\App\Models\Program::all() as $program) {
            $checkboxName = 'programs_' . $program->id;
            if (isset($fields[$checkboxName]) && $fields[$checkboxName]) {
                $programsToSync[$program->id] = ['position' => $position++];
            }
        }
       
        if (isset($fields['current_belt'])) {
            $model->update(['current_belt' => $fields['current_belt']]);
        }
        
        // Save requirements progress
        if ($model->current_belt) {
            $requirements = \App\Models\ProgramBelt::find($model->current_belt)?->requirements ?? [];
            $requirementsProgress = [];
            
            // Create a lookup for requirements by ID
            $requirementLookup = [];
            foreach ($requirements as $requirement) {
                $requirementLookup[$requirement['id']] = $requirement;
            }
            
            // Process form fields
            foreach ($fields as $fieldKey => $value) {
                if (str_starts_with($fieldKey, 'requirements_') && str_ends_with($fieldKey, '_completed')) {
                    // Extract requirement ID from field name
                    $reqId = str_replace(['requirements_', '_completed'], '', $fieldKey);
                    
                    if (isset($requirementLookup[$reqId])) {
                        $requirement = $requirementLookup[$reqId];
                        $requirementsProgress[$reqId] = [
                            'requirement_name' => $requirement['requirement_name'],
                            'type' => $requirement['requirement_type'] ?? null,
                            'completed' => (bool) $value
                        ];
                    }
                }
            }
            
            if (!empty($requirementsProgress)) {
                $model->update(['requirements_progress' => $requirementsProgress]);
            }
        }
        $model->programs()->sync($programsToSync);
        parent::afterSave($model, $fields);
    }



}
