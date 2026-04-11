<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsumableInboundRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'consumable_id' => 'required|exists:consumables,id',
            'supplier_id'   => 'nullable|exists:suppliers,id',
            'inbound_date'  => 'required|date',
            'quantity'      => 'required|integer|min:1',
            'notes'         => 'nullable|string',
        ];
    }
}
