<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends MasterRequest
{

    public function rules(): array
    {
        return [
            'user_id' => 'nullable',
            'parent_id' => 'nullable|int|exists:categories,id',
            'name' => 'required|min:4',
        ];
    }
}
