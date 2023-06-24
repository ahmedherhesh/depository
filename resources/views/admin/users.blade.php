@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="table-responsive ">
            <button class="create-btn btn ctm-btn " data-bs-toggle="modal" data-bs-target="#createUserModal"><i
                    class="fas fa-plus ms-2"></i> <span class="text-light">اضافة مستخدم</span></button>
            <table class="table table-bordered align-middle text-center m-auto mb-5 mt-5">
                <thead class="table-dark">
                    <tr>
                        <th>م</th>
                        <th>الإسم</th>
                        <th>الصلاحية</th>
                        <th>الحالة</th>
                        <th>المخزن</th>
                        <th>تعديل</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->depot->name ?? '---' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="text-secondary btn p-0 edit-btn"
                                        data-user-infos='{"user_id":"{{ $user->id }}","name":"{{ $user->name }}","username":"{{ $user->username }}",
                                            "role":"{{ $user->role }}","status":"{{ $user->status }}","depot_id":"{{ $user->depot_id }}"}'
                                        data-bs-toggle="modal" data-bs-target="#updateUserModal"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="text-secondary btn delete-btn p-0" data-type="المستخدم"
                                            class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('includes.modals.users.create-modal', ['depositories' => $depositories])
    @include('includes.modals.users.edit-modal', ['depositories' => $depositories])
@section('js')
    @parent
    <script>
        $('.edit-btn').on('click',function(){
            let editBtn = $(this)
            let data = $(this).data('user-infos')
            $('#edit_name').val(data.name)
            $('#edit_username').val(data.username)
            $('#edit_role').val(data.role)
            $('#edit_status').val(data.status)
            $('#edit_depot_id').val(data.depot_id)
            $('#user_update').attr('action',"{{route('users.update','')}}/" + data.user_id)
        })
    </script>
@endsection
@endsection
