<?php

namespace App\Models;

use App\Enums\PlayerStateEnum;
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

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
