<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Procurement extends Model
{
    protected $fillable = [
        'procurement_code',
        'supplier_id',
        'procurement_date',
        'total_amount',
        'user_id',
        'notes',
    ];

    protected $casts = [
        'procurement_date' => 'date',
        'total_amount'     => 'decimal:2',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
