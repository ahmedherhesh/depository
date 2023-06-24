<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends MasterController
{
    public function login()
    {
        if (session()->has('user'))
            return redirect()->back();
        return view('auth.login');
    }
    public function _login(LoginRequest $request)
    {
        $user = $request->only('username', 'password');
        $user = auth()->attempt($user);
        if ($user) {
            $request->session()->put('user', auth()->user());
            return redirect('/');
        }
        return redirect()->back()->with('login_failed', 'إسم المستخدم أو كلمة السر غير صحيحة');
    }
    public function changePassword()
    {
        return view('auth.change-password');
    }
    public function _changePassword(ChangePasswordRequest $request)
    {
        $user = User::find($this->user()->id);
        if (Hash::check($request->oldPassword, $user->password)) {
            $user = $user->update(['password' => $request->password]);
            if ($user)
                return redirect()->back()->with('success', 'تم تغيير كلمة السر بنجاح');
        }
        return redirect()->back()->with('password-error', 'كلمة السر القديمة غير صحيحه');
    }
    public function logout()
    {
        session()->forget('user');
        return redirect('login');
    }
}
