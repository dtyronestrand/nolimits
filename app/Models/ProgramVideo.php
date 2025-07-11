<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasNesting;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class ProgramVideo extends Model implements Sortable
{
    use HasSlug, HasPosition, HasNesting;

    protected $fillable = [
        'published',
        'title',
        'url',
        'position',
        'program_id',
    ];
    
    public $slugAttributes = [
        'title',
    ];
    
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
