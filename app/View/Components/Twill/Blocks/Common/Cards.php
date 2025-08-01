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
        
            InlineRepeater::make()
                ->name('cards')
                ->label(__('Cards'))
                ->triggerText(__('Add Card'))
                ->fields([
                    Select::make()
                ->name('type')
                ->label(__('Type'))
                ->options([
                    Option::make('profile', __('Profile')),
                    Option::make('scroll', __('Scroll')),
                    Option::make('button', __('Button')),
                    Option::make('carousel', __('Carousel')),
                ]),
                    Input::make()->name('title'),
                    Input::make()->name('details'),
                    Input::make()->name('button_text')->connectedTo('type', 'button'),
                    Input::make()->name('button_link')->connectedTo('type', 'button'),
                    Medias::make()->name('image')->max(1)
                ])
        ]);
            
    
    }

}