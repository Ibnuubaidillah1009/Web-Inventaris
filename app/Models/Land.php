<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Land extends Model
{
    protected $fillable = [
        'land_code',
        'name',
        'address',
        'area_size',
        'certificate_number',
        'is_active',
    ];

    protected $casts = [
        'area_size' => 'decimal:2',
        'is_active'  => 'boolean',
    ];

    public function buildings(): HasMany
    {
        return $this->hasMany(Building::class);
    }
}
