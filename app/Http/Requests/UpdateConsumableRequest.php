<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConsumableRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $consumableId = $this->route('consumable');

        return [
            'item_code' => "sometimes|required|string|max:100|unique:consumables,item_code,{$consumableId}",
            'name'      => 'sometimes|required|string|max:255',
            'unit'      => 'sometimes|required|string|max:50',
            'min_stock' => 'nullable|integer|min:0',
        ];
    }
}
