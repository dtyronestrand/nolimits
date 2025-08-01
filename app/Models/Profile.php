<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasRelated;
use App\Models\Program;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model 
{
    use HasBlocks, HasTranslation, HasRelated, HasSlug;

    protected $fillable = [
        'name',
        'description',
        'first_name',
        'last_name',
        'bio',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'phone',
        'current_belt',
        'requirements_progress',
    ];
    
    protected $casts = [
        'requirements_progress' => 'array',
    ];
    
    public $translatedAttributes = [
        'active',
    ];
    
    public $slugAttributes = [
        'name',
    ];
    
    public $publicAttributes = [
        'id',
        'name',
        'first_name',
        'last_name',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'phone',
        'bio',
        'current_belt',
        'current_belt_name',
        'requirements_progress',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class);
    }

    public function programBelts()
    {
        return $this->hasMany(ProgramBelt::class)
            ->orderBy('position');
    }
    
    public function currentBelt(): BelongsTo
    {
        return $this->belongsTo(ProgramBelt::class, 'current_belt');
    }
    
    public function getCurrentBeltNameAttribute()
    {
        return $this->current_belt ? ProgramBelt::find($this->current_belt)?->name : '-';
    }
    
    public function tkdApplications(): HasMany
    {
        return $this->hasMany(TKDApplication::class);
    }
}
