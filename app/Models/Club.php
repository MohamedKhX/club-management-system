<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Club extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;

    protected $guarded = [];

    public function sportFederation(): BelongsTo
    {
        return $this->belongsTo(SportFederation::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
