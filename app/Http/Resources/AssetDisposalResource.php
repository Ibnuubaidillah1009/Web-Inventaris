<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetDisposalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'disposal_date' => $this->disposal_date?->toDateString(),
            'reason'        => $this->reason,
            'notes'         => $this->notes,
            'asset_type'    => class_basename($this->disposable_type),
            'asset'         => $this->whenLoaded('disposable', fn() => [
                'id'   => $this->disposable->id,
                'name' => $this->disposable->name,
            ]),
            'created_by' => $this->whenLoaded('user', fn() => $this->user->name),
            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
