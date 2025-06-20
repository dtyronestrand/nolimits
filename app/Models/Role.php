<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
public function  profiles(): BelongsToMany
{
    return $this->belongsToMany(Profile::class);
}
}
