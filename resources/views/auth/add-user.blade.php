@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="d-flex justify-content-center align-items-center mt-5">
            <form class="custom-form" action="{{ route('register') }}" method="POST">
                @csrf
                <h4 class="text-center mb-3">إضافة مستخدم</h4>
    
                <div class="mb-3">
                    <label for="name" class="form-label">الإسم بالكامل</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                    @if ($errors->has('name'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">اسم المستخدم</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                    @if ($errors->has('username'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">الصلاحية</label>
                    <select class="form-control" name="role" id="role">
                        <option value="user">مستخدم</option>
                        <option value="admin">أدمن</option>
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">كلمة السر</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @if ($errors->has('password'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn ctm-btn">إنشاء حساب</button>
            </form>
        </div>
    </div>
@endsection
