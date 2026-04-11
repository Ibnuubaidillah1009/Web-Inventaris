<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsumableInboundResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'inbound_date' => $this->inbound_date?->toDateString(),
            'quantity'     => $this->quantity,
            'notes'        => $this->notes,
            'consumable'   => new ConsumableResource($this->whenLoaded('consumable')),
            'supplier'     => new SupplierResource($this->whenLoaded('supplier')),
            'created_by'   => $this->whenLoaded('user', fn() => $this->user->name),
            'created_at'   => $this->created_at?->toDateTimeString(),
        ];
    }
}
