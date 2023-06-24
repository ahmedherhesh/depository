<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnItemRequest extends MasterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|exists:user,id',
            'item_id' => 'required|exists:items,id',
            'returned_item_id' => 'nullable|exists:item_returns,id',
            'delivery_id' => 'required|exists:deliveries,id',
            'recipient_name' => 'required',
            'notes' => 'nullable:min:4',
            'qty' => 'required|min:1',
            'status' => 'required|in:new,used,expired',
            'in_stock' => 'nullable|in:0,1',
            'inStock' => 'nullable|in:0,1',
        ];
    }
}
