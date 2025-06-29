<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class ProgramBelt extends Model implements Sortable
{
    use HasBlocks, HasSlug, HasPosition;

    protected $fillable = [
        'name',
        'category',
        'color',
        'program_id',
        'position',
    ];
    
    public $slugAttributes = [
        'name',
    ];
    
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
