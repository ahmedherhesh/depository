<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'oldPassword' => ['required', 'min:6'],
            'password' => ['required', 'min:6'],
            'repeatPassword' => ['required', 'same:password'],
        ];
    }
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'min' => 'احرف هذا الحقل يجب ان تكون 6 فأكثر',
            'same' => 'كلمة السر والتأكيد غير متطابقان',
        ];
    }
}
