<?php

namespace App\Models;

use App\Enums\ReportStateEnum;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    protected $casts = [
        'state' => ReportStateEnum::class,
    ];
}
