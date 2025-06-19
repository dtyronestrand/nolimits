<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Medias;

class Cards extends Base
{


    public function getForm(): Form
    {
        return Form::make([
            Input::make()->name('heading'),
            InlineRepeater::make()
            ->name('cards')
            ->label(__('Cards'))
            ->triggerText(__('Add Card'))
            ->fields([
            Input::make()->name('title'),
            Input::make()->name('details'),
            Medias::make()->name('image')
            ->max(1)
            ])
        ]);
    }
}
