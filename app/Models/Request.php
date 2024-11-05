<?php

namespace App\Models;

use App\Enums\RequestTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $guarded = [];

    protected $casts = [
        'type' => RequestTypeEnum::class
    ];
}
