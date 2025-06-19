<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use App\Models\Base\Model;

class Page extends Model implements Sortable
{
    use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions, HasPosition, HasNesting;

    protected $fillable = [
        'published',
        'title',
        'meta_title',
        'meta_description',
        'position',
    ];
    
    public $translatedAttributes = [
        'title',
        'meta_title',
        'meta_description',
        'active',
    ];
    
    public $slugAttributes = [
        'title',
    ];
    public array $publicAttributes = [
        'title',
        'meta_title',
        'meta_description',
        'blocks',
        'position',
    ];
}
