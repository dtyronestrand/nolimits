<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Breadcrumbs\NestedBreadcrumbs;
use A17\Twill\Services\Forms\Fields\Color;
use A17\Twill\Services\Forms\Fields\Select;
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
                    );

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('description')->title('Description')
        );

        return $table;
    }
}
