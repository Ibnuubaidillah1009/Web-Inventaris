<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsumableRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'item_code' => 'required|string|max:100|unique:consumables,item_code',
            'name'      => 'required|string|max:255',
            'unit'      => 'required|string|max:50',
            'min_stock' => 'nullable|integer|min:0',
        ];
    }
}
