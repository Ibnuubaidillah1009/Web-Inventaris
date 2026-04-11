<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsumableResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'item_code'     => $this->item_code,
            'name'          => $this->name,
            'unit'          => $this->unit,
            'min_stock'     => $this->min_stock,
            'current_stock' => $this->current_stock,
            'is_low_stock'  => $this->current_stock <= $this->min_stock,
            'created_at'    => $this->created_at?->toDateTimeString(),
        ];
    }
}
