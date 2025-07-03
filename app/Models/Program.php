<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Behaviors\Sortable;
use App\Models\Base\Model;

class Program extends Model implements Sortable
{
    use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions, HasRelated, HasPosition, HasNesting;

    protected $fillable = [
        'published',
        'title',
        'tagline',
        'position',
       
    
    ];
    
    public $translatedAttributes = [
        'title',
        'tagline',
    ];
    
    public $slugAttributes = [
        'title',
    ];
    
    public array $publicAttributes = [
        'title',
        'tagline',
        'blocks',
        'medias',
    ];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->orderBy('position');
    }

    public function programBelts()
    {
        return $this->hasMany(ProgramBelt::class);
    }
    
    public function belts()
    {
        return $this->hasMany(ProgramBelt::class);
    }
}
