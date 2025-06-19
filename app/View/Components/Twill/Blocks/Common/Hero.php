<?php

namespace App\View\Components\Twill\Blocks\Common;


use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Fields\Medias;


class Hero extends Base
{
 


    public function getForm(): Form
    {
        return Form::make([
        Select::make()
            ->name('variant')
            ->label(__('Variant'))
            ->options(
                Options::make([
                    Option::make('default', 'Default'),
                Option::make('banner', 'Banner'),
                ])
                ),
            Input::make()->name('heading'),
            Input::make()->name('details')->connectedTo('variant', 'default'),
            Input::make()->name('button_text')->connectedTo('variant', 'default'),
            Input::make()->name('button_url')->connectedTo('variant', 'default'),
            Wysiwyg::make()->name('text')->connectedTo('variant', 'banner'),
            Medias::make()->name('image')->label(__('Image'))
                ->max(1)
        ]);
    }
     public static function getCrops(): array
    {
        return [
            'image'=> [
                'desktop'=>[
                    [
                        'name' => 'desktop',
                        'ratio'=> 16/9,
    
                    ],
                ],
                'tablet'=>[
                    [
                        'name' => 'tablet',
                        'ratio'=> 4/3,
                    ],
                ],
                'mobile'=>[
                    [
                        'name' => 'mobile',
                        'ratio'=> 1,
                    ],
                ]
            ],
        ];
    }
    public static function getBlockTitle(): string
    {
        return __('Hero');
    }
    public static function getBlockIcon(): string{
        return 'b-activity';
    }
}
