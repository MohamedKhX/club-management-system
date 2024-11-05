<?php

namespace App\Models;

use App\Enums\PlayerStateEnum;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = [];

    protected $casts = [
        'state' => PlayerStateEnum::class,
    ];
}
