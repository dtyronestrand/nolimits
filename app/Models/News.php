<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use App\Models\Base\Model;

class News extends Model implements Sortable
{
    use HasBlocks, HasTranslation, HasSlug, HasPosition, HasMedias, HasNesting;

    protected $fillable = [
        'published',
        'title',
        'position',
    ];
    
    public $translatedAttributes = [
        'title',
      
    ];
    
    public $slugAttributes = [
        'title',
    ];
    
    public $publicAttributes = [
        'id',
        'title',
        'blocks',
        'medias',
    ];
}
