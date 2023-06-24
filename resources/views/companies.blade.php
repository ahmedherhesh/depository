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
                        <th>المنتجات </th>
                        <th>التاريخ </th>
                        <th>تعديل</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $key => $company)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $company->name }}</td>
                            <td><a href="{{ route('companies.show', $company->id) }}">عرض</a></td>
                            <td>{{ $company->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="text-secondary btn p-0 edit-btn"
                                        data-company-infos='{"company_id":"{{ $company->id }}","name":"{{ $company->name }}"}'
                                        data-bs-toggle="modal" data-bs-target="#updateCompanyModal"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="text-secondary btn delete-btn p-0" data-type="الشركة"
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
    @include('includes.modals.companies.create-modal')
    @include('includes.modals.companies.edit-modal')
@endsection
@section('js')
    @parent
    <script>
        $('.edit-btn').on('click', function() {
            let editBtn = $(this)
            let data = $(this).data('company-infos')
            $('#edit_name').val(data.name)
            $('#company_update').attr('action', "{{ route('companies.update', '') }}/" + data.company_id)
        })
    </script>
@endsection
