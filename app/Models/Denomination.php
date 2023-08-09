<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Denomination extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function prizes(): HasMany
    {
        return $this->hasMany(Prize::class);
    }

    public function draws(): HasMany
    {
        return $this->hasMany(Draw::class);
    }

    public function drawResults(): HasMany
    {
        return $this->hasMany(DrawResult::class);
    }
}
