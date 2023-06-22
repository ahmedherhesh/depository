<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\MasterRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends MasterRequest
{

    public function rules(): array
    {
        return [
            'name'     => 'required|min:4',
            'username' => 'required|min:4|unique:users,username',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,user'
        ];
    }
}
