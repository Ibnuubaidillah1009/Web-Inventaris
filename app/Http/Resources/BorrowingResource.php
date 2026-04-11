<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                   => $this->id,
            'borrow_code'          => $this->borrow_code,
            'borrower_name'        => $this->borrower_name,
            'borrow_date'          => $this->borrow_date?->toDateString(),
            'expected_return_date' => $this->expected_return_date?->toDateString(),
            'actual_return_date'   => $this->actual_return_date?->toDateString(),
            'status'               => $this->status,
            'created_by'           => $this->whenLoaded('user', fn() => $this->user->name),
            'details'              => BorrowingDetailResource::collection($this->whenLoaded('details')),
            'created_at'           => $this->created_at?->toDateTimeString(),
        ];
    }
}
