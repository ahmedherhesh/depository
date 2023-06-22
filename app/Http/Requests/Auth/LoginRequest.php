<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\MasterRequest;

class LoginRequest extends MasterRequest
{

    public function rules(): array
    {
        return [
            'username' => ['required', 'exists:users,username'],
            'password' => ['required', 'min:6']
        ];
    }
}
