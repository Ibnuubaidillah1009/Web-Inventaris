<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsumableOutbound extends Model
{
    protected $fillable = [
        'consumable_id',
        'outbound_date',
        'quantity',
        'recipient_name',
        'user_id',
        'notes',
    ];

    protected $casts = [
        'quantity'      => 'integer',
        'outbound_date' => 'date',
    ];

    public function consumable(): BelongsTo
    {
        return $this->belongsTo(Consumable::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
