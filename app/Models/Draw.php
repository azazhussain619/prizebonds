<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Draw extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function denomination(): BelongsTo
    {
        return $this->belongsTo(Denomination::class);
    }

    public function drawResults(): HasMany
    {
        return $this->hasMany(DrawResult::class);
    }

    public function getDateAttribute()
    {
        return date_format(date_create($this->attributes['date']), 'd-M-Y');
    }
}
