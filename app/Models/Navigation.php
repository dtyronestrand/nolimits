<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use App\Models\Base\Model;

class Navigation extends Model implements Sortable
{
    use HasTranslation, HasPosition, HasNesting;

    protected $fillable = [
    
        'position',
        'url',
        'has_submenu',
        'submenu',
    ];
    protected $casts =[
        'submenu' => 'array'
    ];

    public $translatedAttributes = [
        'title',
        'description',
    ];
    
}
