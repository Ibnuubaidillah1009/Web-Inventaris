<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FixedAssetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'asset_code'       => $this->asset_code,
            'qr_code'          => $this->qr_code,
            'name'             => $this->name,
            'brand'            => $this->brand,
            'purchase_year'    => $this->purchase_year,
            'condition_status' => $this->condition_status,
            'is_active'        => $this->is_active,
            'location'         => new LocationResource($this->whenLoaded('location')),
            'created_at'       => $this->created_at?->toDateTimeString(),
            'updated_at'       => $this->updated_at?->toDateTimeString(),
        ];
    }
}
