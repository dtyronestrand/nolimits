<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class WebsiteGuide extends Model implements Sortable
{
    use HasSlug, HasRevisions, HasPosition, HasNesting;

    protected $fillable = [
        'published',
        'title',
  
        'position',
    ];
    
    public $slugAttributes = [
        'title',
    ];
    
}
