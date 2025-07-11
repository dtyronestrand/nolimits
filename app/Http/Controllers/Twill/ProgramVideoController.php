<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Breadcrumbs\NestedBreadcrumbs;
use A17\Twill\Http\Controllers\Admin\NestedModuleController as BaseModuleController;

class ProgramVideoController extends BaseModuleController
{
    protected $moduleName = 'programs.videos';
    protected $modelName = 'ProgramVideo';
    protected $showOnlyParentItemsInBrowsers = true;
    protected $nestedItemsDepth = 1;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->enableReorder();
        if (request('program')) {
            $this->setBreadcrumbs(
                NestedBreadcrumbs::make()
                ->forParent(
                    parentModule: 'programs',
                    module: $this->moduleName,
                    activeParentId: request('program'),
                    repository: \App\Repositories\ProgramRepository::class
                )
                ->label('Video')
            

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
            Input::make()->name('url')->label('URL')
        );

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */

}
