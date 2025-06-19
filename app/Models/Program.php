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

class Program extends Model implements Sortable
{
    use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions, HasPosition, HasNesting;

    protected $fillable = [
        'published',
        'title',
       'tagline',
        'meta_title',
        'meta_description',
        'position',
    ];
    
protected $translatable =[
        'title',
        'tagline',
        'meta_title',
        'meta_description',
        'active',
    ];
    
    public array $publicAttributes = [
        'title',
        'tagline',
        'meta_title',
        'meta_description',
        'blocks',
        'position',
    ];
    
    
    public $slugAttributes = [
        'title',
    ];
    
}
