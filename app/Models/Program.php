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

    protected static function boot()
    {
        parent::boot();

        // Ensure all translatedAttributes are strings when the model is retrieved
        static::retrieved(function ($model) {
            if (property_exists($model, 'translatedAttributes') && is_array($model->translatedAttributes)) {
                $model->translatedAttributes = array_filter($model->translatedAttributes, function ($attribute) {
                    return is_string($attribute);
                });
            }
        });
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->orderBy('position');
    }
}
