<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends MasterRequest
{

    public function rules(): array
    {
        return [
            'user_id' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'parent_id' => 'nullable|int|exists:categories,id',
            'name' => 'nullable|min:4',
        ];
    }
}
