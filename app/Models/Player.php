<?php

namespace App\Models;

use App\Enums\PlayerStateEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Player extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'state' => PlayerStateEnum::class,
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function contract(): Attribute
    {
        return Attribute::get(function () {
            return $this->getMedia('contract');
        });
    }
}
