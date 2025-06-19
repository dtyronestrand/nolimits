<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\Checkbox;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Input;
use Illuminate\Support\Facades\Log;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\NestedModuleController as BaseModuleController;

class NavigationController extends BaseModuleController
{
    protected $moduleName = 'navigations';
    protected $showOnlyParentItemsInBrowsers = true;
    protected $nestedItemsDepth = 1;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->disablePermalink();
        $this->enableReorder();
    }


    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

       $form->add(
            Input::make()
            ->name('title')
            ->label('Title')
            ->translatable()
       );
       $form->add(
            Input::make()
            ->name('url')
            ->label('URL')
       
      );
      $form->add(
        Checkbox::make()
        ->name('has_submenu')
        ->label('Has Submenu')
      
      );
      $form->add(
        InlineRepeater::make()
        ->name('submenu')
        ->label('Sub Menu Item')
        ->triggerText('Add Sub Menu Item')
        ->fields([
            Input::make()
            ->name('title')
            ->label('Title'),
       
            Input::make()
            ->name('url')
            ->label('URL')
    
      ])->connectedTo('has_submenu', true)
        );

        return $form;
    }



}
