@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="d-flex justify-content-center align-items-center mt-5">
            <form class="custom-form" action="{{ route('change_password') }}" method="POST">
                @csrf
                <h4 class="text-center mb-4">تغيير كلمة السر</h4>
                @if (session()->has('password-error'))
                    <span class="text-danger text-direction-rtl">{{ $errors->first('password') }}</span>
                    <p class="alert alert-danger text-center">{{ session()->get('password-error') }}</p>
                @endif
                <div class="mb-3">
                    <label for="oldPassword" class="form-label">كلمة السر القديمة</label>
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                    @if ($errors->has('oldPassword'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('oldPassword') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">كلمة السر الجديدة</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @if ($errors->has('password'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">تأكيد كلمة السر</label>
                    <input type="password" class="form-control" id="repeatPassword" name="repeatPassword">
                    @if ($errors->has('repeatPassword'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('repeatPassword') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn ctm-btn">حفظ</button>
            </form>
        </div>
    </div>
@endsection
