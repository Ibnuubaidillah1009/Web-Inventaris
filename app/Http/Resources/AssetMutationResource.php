<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetMutationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'mutation_date' => $this->mutation_date?->toDateString(),
            'notes'         => $this->notes,
            'fixed_asset'   => new FixedAssetResource($this->whenLoaded('fixedAsset')),
            'from_location' => new LocationResource($this->whenLoaded('fromLocation')),
            'to_location'   => new LocationResource($this->whenLoaded('toLocation')),
            'created_by'    => $this->whenLoaded('user', fn() => $this->user->name),
            'created_at'    => $this->created_at?->toDateTimeString(),
        ];
    }
}
