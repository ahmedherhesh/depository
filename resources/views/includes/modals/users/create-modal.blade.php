<div class="modal fade mt-5" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mb-2">إضافة مستخدم</h4>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">الإسم بالكامل</label>
                        <input type="text" class="form-control" id="name" name="name"
                            aria-describedby="emailHelp" value="{{old('name')}}">
                        @if ($errors->has('name'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">اسم المستخدم</label>
                        <input type="text" class="form-control" id="username" name="username"
                            aria-describedby="emailHelp" value="{{old('username')}}">
                        @if ($errors->has('username'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="depot_id" class="form-label">المخزن</label>
                        <select class="form-select" name="depot_id" id="depot_id">
                            <option value=""></option>
                            @foreach ($depositories as $depository)
                                <option value="{{ $depository->id }}">{{ $depository->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('depot_id'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('depot_id') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">الصلاحية</label>
                        <select class="form-select" name="role" id="role">
                            @foreach (config('enums.roles') as $key => $role)
                                <option value="{{$key}}">{{$role}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('role') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">الحاله</label>
                        <select class="form-select" name="status" id="status">
                            @foreach (config('enums.user_status') as $key => $status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة السر</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                        @if ($errors->has('password'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn ctm-btn">إنشاء حساب</button>
                </form>

            </div>
        </div>
    </div>
</div>
