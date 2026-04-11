<?php

namespace App\Observers;

use App\Models\ConsumableInbound;

class ConsumableInboundObserver
{
    /**
     * Setelah record inbound berhasil dibuat,
     * tambahkan quantity ke current_stock consumable.
     */
    public function created(ConsumableInbound $inbound): void
    {
        $inbound->consumable()->increment('current_stock', $inbound->quantity);
    }

    /**
     * Jika record inbound diupdate, hitung selisih quantity
     * lalu sesuaikan current_stock.
     */
    public function updated(ConsumableInbound $inbound): void
    {
        $diff = $inbound->quantity - $inbound->getOriginal('quantity');
        if ($diff !== 0) {
            $inbound->consumable()->increment('current_stock', $diff);
        }
    }

    /**
     * Jika record inbound dihapus, kurangi kembali stock.
     */
    public function deleted(ConsumableInbound $inbound): void
    {
        $inbound->consumable()->decrement('current_stock', $inbound->quantity);
    }
}
