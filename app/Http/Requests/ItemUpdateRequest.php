<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends MasterRequest
{

    public function rules(): array
    {
        return [
            'user_id' => 'nullable',
            'item_id' => 'required|exists:items,id',
            'title' => 'required|min:4',
            'notes' => 'nullable|min:4',
            'date' => 'required',
            'cat_id' => 'nullable|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:categories,id',
            'company_id' => 'nullable|exists:companies,id',
            'depot_id' => 'nullable|exists:depositories,id',
            'price' => 'required|numeric|min:1',
            'qty' => 'required|numeric|min:1',
            'allowed_qty' => 'nullable|numeric|min:1',
            'status' => 'required|in:new,used,expired'
        ];
    }
}
