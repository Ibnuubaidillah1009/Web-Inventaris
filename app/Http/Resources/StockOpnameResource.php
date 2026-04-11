<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockOpnameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'opname_date'      => $this->opname_date?->toDateString(),
            'actual_condition' => $this->actual_condition,
            'notes'            => $this->notes,
            'asset_type'       => class_basename($this->opnable_type),
            'asset'            => $this->whenLoaded('opnable', fn() => [
                'id'   => $this->opnable->id,
                'name' => $this->opnable->name,
            ]),
            'created_by'  => $this->whenLoaded('user', fn() => $this->user->name),
            'created_at'  => $this->created_at?->toDateTimeString(),
        ];
    }
}
