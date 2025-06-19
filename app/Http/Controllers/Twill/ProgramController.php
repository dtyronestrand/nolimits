<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;


use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fieldset;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\NestedModuleController as BaseModuleController;
use App\Models\Program as ProgramModel;


class ProgramController extends BaseModuleController
{
    protected $moduleName = 'programs';
    protected $showOnlyParentItemsInBrowsers = true;
    protected $nestedItemsDepth = 1;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->enableReorder();
        $this->setPermalinkBase('programs');
        $this->withoutLanguageInPermalink();
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);
        $form->add(
            Input::make()
            ->name('tagline')
            ->label('Tagline')
        );
        
        $form->add(
            BlockEditor::make()
            ->withoutSeparator()
        );

        return $form;
    }
    public function getSideFieldsets(TwillModelContract $model): Form
    {
        $form = parent::getSideFieldsets($model);

        $form->addFieldset(
            Fieldset::make()
                ->title('SEO')
                ->id('seo')
                ->fields([
                    Input::make()
                        ->name('meta_title')
                        ->label('Meta title')
                        // Program model's meta_title is not translatable
                        ->maxlength(200),
                    Input::make()
                        ->name('meta_description')
                        ->label('Meta description')
                        // Program model's meta_description is not translatable
                        ->maxlength(200)
                ])
        );
        return $form;
    }
 

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */

}
