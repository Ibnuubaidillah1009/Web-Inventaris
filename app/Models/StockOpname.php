<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StockOpname extends Model
{
    protected $fillable = [
        'opnable_type',
        'opnable_id',
        'opname_date',
        'actual_condition',
        'user_id',
        'notes',
    ];

    protected $casts = [
        'opname_date' => 'date',
    ];

    /**
     * Polymorphic: bisa ke FixedAsset atau Building.
     */
    public function opnable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
