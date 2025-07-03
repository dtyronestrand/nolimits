<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramBelt extends Model implements Sortable
{
    use HasBlocks, HasSlug, HasPosition;

    protected $fillable = [
        'name',
        'category',
        'color',
        'program_id',
        'position',
        'profile_id',
        'requirements',

    ];
    
    protected $casts = [
        'requirements' => 'array',
    ];
    public $slugAttributes = [
        'name',
    ];
    
    public array $publicAttributes = [
        'id',
        'name',
        'category',
        'color',
        'requirements',
        'position',
    ];
    
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }
}
