@extends('base')
@section('content')
    <div class="d-flex justify-content-center align-items-center h-100vh">

        <form class="custom-form" action="{{ route('login') }}" method="POST">
            @csrf
            {{-- <h4 class="text-center mb-3">مرحبا بكم</h4> --}}

            @if (session()->has('login_failed'))
                <span class="text-danger text-direction-rtl">{{ $errors->first('password') }}</span>
                <p class="alert alert-danger text-center">{{ session()->get('login_failed') }}</p>
            @endif
            <div class="mb-3">
                <label for="username" class="form-label">اسم المستخدم</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                @if ($errors->has('username'))
                    <span class="text-danger text-direction-rtl">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">كلمة السر</label>
                <input type="password" class="form-control" id="password" name="password">
                @if ($errors->has('password'))
                    <span class="text-danger text-direction-rtl">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <button type="submit" class="btn ctm-btn">تسجيل الدخول</button>
        </form>
    </div>
@endsection
