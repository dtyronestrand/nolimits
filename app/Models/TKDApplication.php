<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TKDApplication extends Model implements Sortable
{
    use HasFiles, HasRevisions, HasPosition;

    protected $fillable = [
        'published',
        'title',
        'description',
        'position',
        'profile_id',
        'first_name',
        'last_name',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'phone',
    ];
    
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
    
    public function syncWithProfile()
    {
        if ($this->profile) {
            $this->fill([
                'first_name' => $this->first_name ?: $this->profile->first_name,
                'last_name' => $this->last_name ?: $this->profile->last_name,
                'email' => $this->email ?: $this->profile->email,
                'address' => $this->address ?: $this->profile->address,
                'city' => $this->city ?: $this->profile->city,
                'state' => $this->state ?: $this->profile->state,
                'zip' => $this->zip ?: $this->profile->zip,
                'phone' => $this->phone ?: $this->profile->phone,
            ]);
        }
    }
    
    public function updateProfileFromApplication()
    {
        if ($this->profile) {
            $this->profile->update([
                'first_name' => $this->profile->first_name ?: $this->first_name,
                'last_name' => $this->profile->last_name ?: $this->last_name,
                'email' => $this->profile->email ?: $this->email,
                'address' => $this->profile->address ?: $this->address,
                'city' => $this->profile->city ?: $this->city,
                'state' => $this->profile->state ?: $this->state,
                'zip' => $this->profile->zip ?: $this->zip,
                'phone' => $this->profile->phone ?: $this->phone,
            ]);
        }
    }
}
