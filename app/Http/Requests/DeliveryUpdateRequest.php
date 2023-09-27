<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryUpdateRequest extends MasterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'recipient_name' => 'required',
            'side_name' => 'required',
            'notes' => 'nullable|min:4',
            'price' => 'nullable',
            'qty' => 'required|numeric|gt:0',
        ];
    }
}
