<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Checkbox;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Browser;
use App\Models\Program;
use App\Models\ProgramBelt;
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
        )->add(
            Input::make()->name('address')->label('Address')
        )->add(Input::make()->name('city')->label('City')
        )->add(
            Input::make()->name('state')->label('State')
        )->add(
            Input::make()->name('zip')->label('Zip Code')
        )->add(
            Input::make()->name('phone')->label('Phone Number')
        );
 
        foreach (Program::all() as $program) {
            $form->add(
                Checkbox::make()->name('programs_' . $program->id)->label($program->title)
            );
        }
       
        $options = [];
        foreach (ProgramBelt::where('program_id', 1)->get() as $belt) {
            $options[] = Option::make($belt->id, $belt->name);
        }
   
        $form->add(
            Select::make()
                ->name('current_belt')
                ->label('Current Belt')
                ->options(Options::make($options))
        );
        $requirements = ProgramBelt::where('id', $model->current_belt)->first()?->requirements ?? [];
        if ($requirements) {
            foreach ($requirements as $requirement){
                $form->add(
                    Checkbox::make()->name('requirements_' . $requirement['id'] . '_completed')->label($requirement['requirement_name'])
                );
            }
        }
        
        return $form;
    }
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('current_belt_name')->title('Current Belt')->sortable(false)
        );



        return $table;
    }
    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */

}
