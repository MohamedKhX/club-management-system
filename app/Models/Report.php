<?php

namespace App\Models;

use App\Enums\ReportStateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;
    protected $guarded = [];

  /*  protected $casts = [
        'state' => ReportStateEnum::class,
    ];*/

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function sportFederation(): BelongsTo
    {
        return $this->belongsTo(SportFederation::class);
    }
}
