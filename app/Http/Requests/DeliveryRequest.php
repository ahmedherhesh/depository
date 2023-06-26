<?php

namespace App\Http\Requests;


class DeliveryRequest extends MasterRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'item_id' => 'required|exists:items,id',
            'depot_id' => 'nullable|exists:depositories,id',
            'recipient_name' => 'required',
            'side_name' => 'required',
            'notes' => 'nullable|min:4',
            'status' => 'nullable|in:new,used,expired',
            'qty' => 'required|numeric|gt:0',
        ];
    }
}
