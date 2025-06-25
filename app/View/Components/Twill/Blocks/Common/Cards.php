<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Option;

class Cards extends Base
{
    public function getForm(): Form
    {
        // Define the form structure for the Cards block   
    return Form::make([
            Select::make()
                ->name('type')
                ->label(__('Type'))
                ->options([
                    Option::make('profile', __('Profile')),
                    Option::make('scroll', __('Scroll')),
                ]),
            Input::make()->name('heading')->connectedTo('type', 'profile'),
            InlineRepeater::make()
                ->name('cards')
                ->label(__('Cards'))
                ->triggerText(__('Add Card'))
                ->fields([
                    Input::make()->name('title'),
                    Input::make()->name('details'),
                    Medias::make()->name('image')->max(1)
                ])
        ]);
            
    
    }

}