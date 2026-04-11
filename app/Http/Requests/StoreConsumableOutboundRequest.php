<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsumableOutboundRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'consumable_id'  => 'required|exists:consumables,id',
            'outbound_date'  => 'required|date',
            'quantity'       => 'required|integer|min:1',
            'recipient_name' => 'required|string|max:255',
            'notes'          => 'nullable|string',
        ];
    }
}
