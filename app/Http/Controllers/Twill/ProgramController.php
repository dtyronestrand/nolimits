<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Forms\Fields\Checkbox;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Listings\Columns\NestedData;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\NestedModuleController as BaseModuleController;

class ProgramController extends BaseModuleController
{
    protected $moduleName = 'programs';
    protected $showOnlyParentItemsInBrowsers = true;
    protected $nestedItemsDepth = 2;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->enableReorder();
     
        $this->withoutLanguageInPermalink();

    }

      protected function form(?int $id, TwillModelContract $item = null): array
    {
        $item = $this->repository->getById($id, $this->formWith, $this->formWithCount);
 
        $this->permalinkBase = $item->ancestorsSlug;
 
        return parent::form($id, $item);
    }
    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
             Checkbox::make()
            ->name('main_page')
            ->label('Main Page')
        );
        $form->add(
           
            Input::make()->name('tagline')->label('Tagline')->connectedTo('main_page', true)
        );

        $form->add(
            BlockEditor::make()
        );

        return $form;
    }

    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            NestedData::make()->field('belts')
        );
        $table->add(
            NestedData::make()->field('videos')
        );
        return $table;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */

}
