<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Building extends Model
{
    protected $fillable = [
        'building_code',
        'name',
        'land_id',
        'area_size',
        'build_year',
        'condition_status',
        'is_active',
    ];

    protected $casts = [
        'area_size' => 'decimal:2',
        'is_active'  => 'boolean',
    ];

    public function land(): BelongsTo
    {
        return $this->belongsTo(Land::class);
    }

    /**
     * Polymorphic: bangunan bisa di-opname.
     */
    public function stockOpnames(): MorphMany
    {
        return $this->morphMany(StockOpname::class, 'opnable');
    }

    /**
     * Polymorphic: bangunan bisa di-disposal.
     */
    public function assetDisposals(): MorphMany
    {
        return $this->morphMany(AssetDisposal::class, 'disposable');
    }
}
