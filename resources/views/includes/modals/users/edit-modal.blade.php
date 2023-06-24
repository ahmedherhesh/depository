<div class="modal fade mt-5" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="user_update">
                    @csrf
                    <h4 class="text-center mb-3"> تعديل مستخدم</h4>
                    <input type="hidden" class="form-control" name="_method" value="PUT">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">الإسم بالكامل</label>
                        <input type="text" class="form-control" id="edit_name" name="name"
                            aria-describedby="emailHelp" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">اسم المستخدم</label>
                        <input type="text" class="form-control" id="edit_username" name="username"
                            aria-describedby="emailHelp" value="{{ old('username') }}">
                        @if ($errors->has('username'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="edit_depot_id" class="form-label">المخزن</label>
                        <select class="form-select" name="depot_id" id="edit_depot_id">
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
                        <label for="edit_role" class="form-label">الصلاحية</label>
                        <select class="form-select" name="role" id="edit_role">
                            @foreach (config('enums.roles') as $key => $role)
                                <option value="{{ $key }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('role') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">الحاله</label>
                        <select class="form-select" name="status" id="edit_status">
                            @foreach (config('enums.user_status') as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">كلمة السر</label>
                        <input type="password" class="form-control" id="edit_password" name="password"
                            value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn ctm-btn">حفظ</button>
                </form>

            </div>
        </div>
    </div>
</div>
