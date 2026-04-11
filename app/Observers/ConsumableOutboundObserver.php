<?php

namespace App\Observers;

use App\Models\ConsumableOutbound;
use Illuminate\Validation\ValidationException;

class ConsumableOutboundObserver
{
    /**
     * Sebelum record outbound dibuat, pastikan stok mencukupi.
     * Setelah berhasil dibuat, kurangi current_stock.
     */
    public function creating(ConsumableOutbound $outbound): void
    {
        $consumable = $outbound->consumable;

        if ($consumable->current_stock < $outbound->quantity) {
            throw ValidationException::withMessages([
                'quantity' => [
                    "Stok tidak mencukupi. Stok saat ini: {$consumable->current_stock}, diminta: {$outbound->quantity}.",
                ],
            ]);
        }
    }

    public function created(ConsumableOutbound $outbound): void
    {
        $outbound->consumable()->decrement('current_stock', $outbound->quantity);
    }

    /**
     * Jika diupdate, kembalikan stok lama lalu kurangi dengan qty baru.
     */
    public function updating(ConsumableOutbound $outbound): void
    {
        $oldQty = $outbound->getOriginal('quantity');
        $newQty = $outbound->quantity;
        $consumable = $outbound->consumable;

        // Kembalikan stok lama dulu (seolah-olah transaksi lama dibatalkan).
        $projectedStock = $consumable->current_stock + $oldQty;

        if ($projectedStock < $newQty) {
            throw ValidationException::withMessages([
                'quantity' => [
                    "Stok tidak mencukupi untuk update. Stok tersedia (setelah rollback): {$projectedStock}, diminta: {$newQty}.",
                ],
            ]);
        }
    }

    public function updated(ConsumableOutbound $outbound): void
    {
        $diff = $outbound->quantity - $outbound->getOriginal('quantity');
        if ($diff !== 0) {
            // diff positif = keluar lebih banyak → decrement, negatif = keluar lebih sedikit → increment
            $outbound->consumable()->decrement('current_stock', $diff);
        }
    }

    /**
     * Jika outbound dihapus, kembalikan stok.
     */
    public function deleted(ConsumableOutbound $outbound): void
    {
        $outbound->consumable()->increment('current_stock', $outbound->quantity);
    }
}
