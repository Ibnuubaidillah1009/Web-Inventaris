<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsumableInbound extends Model
{
    protected $fillable = [
        'consumable_id',
        'supplier_id',
        'inbound_date',
        'quantity',
        'user_id',
        'notes',
    ];

    protected $casts = [
        'quantity'     => 'integer',
        'inbound_date' => 'date',
    ];

    public function consumable(): BelongsTo
    {
        return $this->belongsTo(Consumable::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
