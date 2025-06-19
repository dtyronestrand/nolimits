<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;

use Illuminate\Contracts\View\View;

class Text extends Base
{

    public function getForm(): Form
    {
        return Form::make([
            Input::make()->name('title'),
            Wysiwyg::make()->name('text')
        ]);
    }
}
