<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\InlineRepeater;
use Illuminate\Contracts\View\View;

class Slider extends Base
{
    public function render(): View
    {
        return view('components.twill.blocks.common.slider');
    }

    public function getForm(): Form
    {
        return Form::make([
            InlineRepeater::make()
            ->name('slides')
            ->label(__('Slides'))
            ->triggerText(__('Add Slide'))
            ->fields([
            Input::make()->name('heading')->label(__('Heading')),
            Input::make()->name('text')->label(__('Text Description')),
            Medias::make()->name('image')->label(__('Image'))
        ])
        ]);
    }
        public static function getCrops(): array
    {
        return [
            'image'=> [
                'desktop'=>[
                    [
                        'name' => 'desktop',
                        'ratio'=> 'free',
    
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
        return __('Slider');
    }
    public static function getBlockIcon(): string{
        return 'image';
    }
}
