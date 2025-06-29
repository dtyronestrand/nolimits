<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Option;
use A17\Twill\View\Components\Blocks\TwillBlockComponent;
use Illuminate\Contracts\View\View;

class Requirements extends Base
{


    public function getForm(): Form
    {
        return Form::make([
         InlineRepeater::make()
         ->name('requirements')
            ->label('Requirements')
            ->fields([
                Select::make()
                ->name('requirement_type')
                ->label('Requirement Type')
                ->options(
                    Options::make([
                        Option::make('poomsae', 'Poomsae'),
                        Option::make('sparring_self-defense', 'Sparring / Self-Defense'),
                        Option::make('breaking', 'Breaking'),
                        Option::make('knowledge', 'Knowledge'),
                        Option::make('other', 'Other'),
                    ])
                    ),
                    Input::make()
                    ->name('requirement_name')
                    ->label('Requirement Name'),
        ])
        ]);
    }
}
