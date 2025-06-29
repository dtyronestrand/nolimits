<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;

use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Checkbox;;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Browser;
use App\Models\Program;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Services\Forms\Option;

class ProfileController extends BaseModuleController
{
    protected $moduleName = 'profiles';
    protected $titleColumnKey = 'name';

    protected $indexOptions = [
        'create' => false,
        'delete' => false,
    ];
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
    }

    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);
 
        $form->add(
            Input::make()->name('first_name')->label('First Name')
        );
        $form->add(
            Input::make()->name('last_name')->label('Last Name')
        );
        $form->add(
            Input::make()->name('email')->label('Email')->readOnly(true)
        );
        
        foreach (Program::all() as $program) {
            $form->add(
                Checkbox::make()->name('programs_' . $program->id)->label($program->title)
            );
        }

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */

}
