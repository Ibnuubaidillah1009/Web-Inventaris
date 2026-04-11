<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsumableOutboundResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'outbound_date'  => $this->outbound_date?->toDateString(),
            'quantity'       => $this->quantity,
            'recipient_name' => $this->recipient_name,
            'notes'          => $this->notes,
            'consumable'     => new ConsumableResource($this->whenLoaded('consumable')),
            'created_by'     => $this->whenLoaded('user', fn() => $this->user->name),
            'created_at'     => $this->created_at?->toDateTimeString(),
        ];
    }
}
