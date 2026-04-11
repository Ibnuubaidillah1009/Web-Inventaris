<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class FixedAsset extends Model
{
    protected $fillable = [
        'asset_code',
        'qr_code',
        'name',
        'location_id',
        'brand',
        'purchase_year',
        'condition_status',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function mutations(): HasMany
    {
        return $this->hasMany(AssetMutation::class);
    }

    public function borrowingDetails(): HasMany
    {
        return $this->hasMany(BorrowingDetail::class);
    }

    /**
     * Polymorphic: aset tetap bisa di-opname.
     */
    public function stockOpnames(): MorphMany
    {
        return $this->morphMany(StockOpname::class, 'opnable');
    }

    /**
     * Polymorphic: aset tetap bisa di-disposal.
     */
    public function assetDisposals(): MorphMany
    {
        return $this->morphMany(AssetDisposal::class, 'disposable');
    }

    /**
     * Local Scope: filter berdasarkan search, condition_status, is_active, location_id.
     * Dipanggil sebagai: FixedAsset::filter(request()->only([...]))->paginate()
     *
     * @param  Builder  $query
     * @param  array<string, mixed>  $filters
     */
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['search'] ?? null, function (Builder $q, string $search) {
                $q->where(function (Builder $inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                          ->orWhere('asset_code', 'like', "%{$search}%")
                          ->orWhere('brand', 'like', "%{$search}%");
                });
            })
            ->when(isset($filters['condition_status']), fn (Builder $q) =>
                $q->where('condition_status', $filters['condition_status'])
            )
            ->when(isset($filters['is_active']), fn (Builder $q) =>
                $q->where('is_active', filter_var($filters['is_active'], FILTER_VALIDATE_BOOLEAN))
            )
            ->when(isset($filters['location_id']), fn (Builder $q) =>
                $q->where('location_id', $filters['location_id'])
            );
    }
}
