<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Option;
use A17\Twill\View\Components\Blocks\TwillBlockComponent;
use Illuminate\Contracts\View\View;

class Bento extends Base
{


    public function getForm(): Form
    {
        return Form::make([
         InlineRepeater::make()
                ->name('bento_items')
                ->label(__('Bento Item'))
                ->fields([
                    Select::make()
                        ->name('size')
                        ->label(__('Size'))
                        ->options(
                            Options::make([
                                Option::make('small', __('Small')),
                                Option::make('medium', __('Medium')),
                                Option::make('large', __('Large')),
                            ])
                        ),
                    Input::make()
                        ->name('title')
                        ->label(__('Title')),
                    Wysiwyg::make()
                            ->name('content') 
                            ->label(__('Content')),
                    Medias::make()
                        ->name('image')
                        ->label(__('Image')),
                    ])
        ]);
    }
        public static function getCrops(): array
    {
        return [
            'image' => [
                'default' => [
                    [
                        'name' => 'default',
                        'ratio' => 'free',
                    ],
                ],
            ],
        ];
    }
    public static function getBlockTitle(): string
    {
        return __('Bento');
    }

}
