<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Medias;

use A17\Twill\View\Components\Blocks\TwillBlockComponent;
use Illuminate\Contracts\View\View;

class News extends Base
{

    public function getForm(): Form
    {
        return Form::make([
            Input::make()
            ->name('heading')
            ->label('News Heading'),
            Input::make()->name('details'),
            Medias::make()
            ->name('image')
        ]);
    }
}
