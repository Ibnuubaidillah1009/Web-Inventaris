<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AssetDisposal extends Model
{
    protected $fillable = [
        'disposable_type',
        'disposable_id',
        'disposal_date',
        'reason',
        'user_id',
        'notes',
    ];

    protected $casts = [
        'disposal_date' => 'date',
    ];

    /**
     * Polymorphic: bisa ke FixedAsset atau Building.
     */
    public function disposable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
