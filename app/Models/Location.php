<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'location_code',
        'name',
        'description',
    ];

    public function fixedAssets(): HasMany
    {
        return $this->hasMany(FixedAsset::class);
    }

    public function mutationsFrom(): HasMany
    {
        return $this->hasMany(AssetMutation::class, 'from_location_id');
    }

    public function mutationsTo(): HasMany
    {
        return $this->hasMany(AssetMutation::class, 'to_location_id');
    }
}
