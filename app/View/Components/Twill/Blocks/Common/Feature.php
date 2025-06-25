<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\InlineRepeater;
use Illuminate\Contracts\View\View;

class Feature extends Base
{


    public function getForm(): Form
    {
        return Form::make([
            Input::make()->name('heading')
                ->label(__('Heading'))
                ->translatable(),
            Input::make()->name('subheading')
                ->label(__('Subheading'))
                ->translatable(),
            Medias::make()
                ->name('image')
                ->label(__('Image'))
                ->max(1),
            InlineRepeater::make()
            ->name('features')
                ->label(__('Features'))
                ->triggerText(__('Add Feature'))
                ->max(2)
                ->fields([
                    Input::make()->name('heading')
                        ->label(__('Heading'))
                        ->translatable(),
                    Input::make()->name('details')
                        ->label(__('Details'))
                        ->translatable(),
              
                ]),
                  InlineRepeater::make()
                    ->name('button_bar')
                    ->label(__('Button Bar'))
                    ->triggerText(__('Add Button'))
                    ->max(6)
                    ->fields([
                        Input::make()->name('button_text')
                            ->label(__('Button Text'))
                            ->translatable(),
                        Input::make()->name('button_link')
                            ->label(__('Button Link'))
                            ->translatable(),
                    ]),
        ]);
    }
    public static function getBlockTitleField(): ?string
    {
        return 'feature';
    }
}
