<?php

namespace App\Models;

use App\Enums\RequestStateEnum;
use App\Enums\RequestTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Request extends Model implements HasMedia
{
    use InteractsWithMedia,
        SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'type' => RequestTypeEnum::class,
        'state' => RequestStateEnum::class
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function sportFederation(): BelongsTo
    {
        return $this->belongsTo(SportFederation::class);
    }
}
