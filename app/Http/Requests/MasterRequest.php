<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'exists' => 'غير موجود',
            'mimes' => 'عفوا هذا الملف غير مدعوم ',
            'min:4' => 'مطلوب 4 احرف على الأقل',
            'min:4' => 'مطلوب 4 احرف على الأقل',
        ];
    }
}
