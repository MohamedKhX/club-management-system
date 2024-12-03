<?php

namespace App\Models;

use App\Enums\PlayerStateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'state' => PlayerStateEnum::class,
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }
}
