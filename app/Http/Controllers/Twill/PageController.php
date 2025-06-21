<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fieldset;
use A17\Twill\Http\Controllers\Admin\NestedModuleController;


class PageController extends NestedModuleController
{
  

    protected $moduleName = 'pages';
    protected $showOnlyParentItemsInBrowsers = false;
    protected $nestedItemsDepth = 2;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->setPermalinkBase('');
        $this->withoutLanguageInPermalink();
        $this->enableReorder();
        $this->nestedItemsDepth = 2;
    }


    protected function form(?int $id, ?TwillModelContract $item = null): array
    {
        $data = parent::form($id, $item);
        if ($data['item']?->id && $data['item']->ancestorsSlug) {
            $data['baseUrl'] .= $data['item']->ancestorsSlug . '/';
        }
        return $data;
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */


    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            BlockEditor::make()
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
                        ->translatable()
                        ->maxlength(200),
                    Input::make()
                        ->name('meta_description')
                        ->label('Meta description')
                        ->translatable()
                        ->maxlength(200),
                ])
        );

        return $form;
    }

    /**
     * @param \A17\Twill\Models\Contracts\TwillModelContract $item
     * @return array
     */
    protected function previewData($item)
    {
        $item->computedBlocks();
        return $this->previewForInertia($item->only($item->publicAttributes), [
            'page'=>'Page',
        ]);
    }
}