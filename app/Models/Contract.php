<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Contract extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;

    protected $guarded = [];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

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

    public function state(): Attribute
    {
        return Attribute::get(function () {
            $today = Carbon::today();

            if ($today->lt($this->start_date)) {
                return 'not_started'; // Contract has not started yet
            }

            if ($today->gt($this->end_date)) {
                return 'expired'; // Contract has ended
            }

            return 'active'; // Contract is currently active
        });
    }
}
