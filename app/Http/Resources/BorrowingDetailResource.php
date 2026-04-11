<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                      => $this->id,
            'condition_when_borrowed' => $this->condition_when_borrowed,
            'condition_when_returned' => $this->condition_when_returned,
            'fixed_asset'             => new FixedAssetResource($this->whenLoaded('fixedAsset')),
        ];
    }
}
