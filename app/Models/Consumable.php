<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consumable extends Model
{
    protected $fillable = [
        'item_code',
        'name',
        'unit',
        'min_stock',
        'current_stock',
    ];

    protected $casts = [
        'min_stock'     => 'integer',
        'current_stock' => 'integer',
    ];

    public function inbounds(): HasMany
    {
        return $this->hasMany(ConsumableInbound::class);
    }

    public function outbounds(): HasMany
    {
        return $this->hasMany(ConsumableOutbound::class);
    }
}
