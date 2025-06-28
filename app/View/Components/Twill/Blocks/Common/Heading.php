<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;


class Heading extends Base
{


    public function getForm(): Form
    {
        return Form::make([
            Input::make()->name('heading')
                ->label('Heading')
                ->translatable(),
            Select::make()
            ->name('level')
            ->label('Heading Level')
            ->options(
                Options::make([
                Option::make('h1','H1' ),
                Option::make('h2','H2' ),
                Option::make('h3','H3' ),
                Option::make('h4','H4' ),
                Option::make('h5','H5' ),
                Option::make('h6','H6' ),
            ]))->translatable(),
        ]);
    }
    public static function getBlockTitleField(): ?string
    {
        return 'heading';
    }
    public static function getBlockTitle(): string
    {
        return __('Heading');
    }
    public static function getBlockIcon(): string{
        return 'wysiwyg_header';
    }
}
