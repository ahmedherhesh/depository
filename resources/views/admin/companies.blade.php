@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="table-responsive ">
            <button class="create-btn btn ctm-btn " data-bs-toggle="modal" data-bs-target="#createCompanyModal"><i
                    class="fas fa-plus ms-2"></i> <span class="text-light">اضافة شركة</span></button>
            <table class="table table-bordered align-middle text-center m-auto mb-5 mt-5">
                <thead class="table-dark">
                    <tr>
                        <th>م</th>
                        <th>الإسم</th>
                        <th>المنتجات</th>
                        <th>التاريخ</th>
                        <th>تعديل</th>
                    </tr>
                </thead>
                <tbody>
                    b:foreach
                    <tr>
                        <td>1</td>
                        <td>الإسم</td>
                        <td>تاريخ الإنشاء</td>
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
                                    <button type="submit" class="text-secondary btn delete-btn p-0" data-type="المنتج"
                                        class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @include('includes.modals.companies.create-modal')
    @include('includes.modals.companies.edit-modal')
@endsection
