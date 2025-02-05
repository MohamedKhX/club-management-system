<?php

namespace App\Models;

use App\Enums\PlayerStateEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Player extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'state' => PlayerStateEnum::class,
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
        $this->addMediaCollection('birth_certificate')->singleFile();
        $this->addMediaCollection('passport')->singleFile();
    }

    public function avatar(): Attribute
    {
        return Attribute::get(fn() => $this->getMedia('avatar'));
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function name(): Attribute
    {
        return new Attribute(function ($value) {
            return $this->first_name . ' ' . $this->last_name;
        });
    }

    public function followingClub(): Attribute
    {
        return Attribute::get(function () {
            $activeContract = $this->contracts()
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->whereNull('date_of_cancellation')
                ->latest('end_date') // Get the most recent contract that is still valid
                ->first();

            return $activeContract ? $activeContract->club->name : 'لا يتبع أي نادي';
        });
    }
}
