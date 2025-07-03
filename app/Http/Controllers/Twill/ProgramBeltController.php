<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;

use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Breadcrumbs\NestedBreadcrumbs;
use A17\Twill\Services\Forms\Fields\Color;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Fields\Checkbox;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Services\Forms\Option;

class ProgramBeltController extends BaseModuleController
{
    protected $moduleName = 'programs.belts';
    protected $modelName = 'ProgramBelt';
    protected $titleColumnKey = 'name';
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        if (request('program')){
            $this->setBreadcrumbs(
                NestedBreadcrumbs::make()
                ->forParent(
                    parentModule: 'programs',
                    module: $this->moduleName,
                    activeParentId: request('program'),
                    repository: \App\Repositories\ProgramRepository::class,
                )
                ->label('Belt')
                );
        }
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Color::make()->name('color')->label('Color')
        )

        ->add(
            Select::make()
                ->name('category')
                ->label('Category')
                ->options(
                    Options::make([
                        Option::make('beginner', 'Beginner'),
                        Option::make('intermediate', 'Intermediate'),
                        Option::make('advanced', 'Advanced'),
                        Option::make('bo-dan', 'Bo-Dan'),
                        Option::make('black', 'Black'),
                    ])
                )
                    )
                    ->add(
                       InlineRepeater::make()
                        ->name('requirements')
                        ->label('Requirements')
                        ->fields([
                              Select::make()
                ->name('requirement_type')
                ->label('Requirement Type')
                ->options(
                    Options::make([
                        Option::make('poomsae', 'Poomsae'),
                        Option::make('sparring_self-defense', 'Sparring / Self-Defense'),
                        Option::make('breaking', 'Breaking'),
                        Option::make('knowledge', 'Knowledge'),
                        Option::make('other', 'Other'),
                    ])
                    ),
                    Input::make()
                    ->name('requirement_name')
                    ->label('Requirement Name'),
                    Select::make()
                    ->name('completed')
                    ->label('Completed')
                    ->options(
                        Options::make([
                            Option::make(0, 'No'),
                            Option::make(1, 'Yes'),
                        ])
                    )
                  
        ])
             
                );
        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */

}
