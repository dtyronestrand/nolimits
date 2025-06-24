<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasRelated;
use App\Models\Program;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    ];
    
    public $translatedAttributes = [
        'active',
    ];
    
    public $slugAttributes = [
        'name',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class);
    }

}
