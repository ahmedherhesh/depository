@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="table-responsive ">
            <button class="create-btn btn ctm-btn " data-bs-toggle="modal" data-bs-target="#createDepositoryModal"><i
                    class="fas fa-plus ms-2"></i> <span class="text-light">اضافة مخزن</span></button>
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
                    @foreach ($depositories as $key => $depository)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $depository->name }}</td>
                            <td><a href="{{ route('depositories.show', $depository->id) }}">عرض</a></td>
                            <td>{{ $depository->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="text-secondary btn p-0 edit-btn"
                                        data-depot-infos='{"depot_id":"{{ $depository->id }}","name":"{{ $depository->name }}"}'
                                        data-bs-toggle="modal" data-bs-target="#updateDepositoryModal"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                    <form action="{{ route('depositories.destroy', $depository->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="text-secondary btn delete-btn p-0" data-type="المنتج"
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
    @include('includes.modals.depositories.create-modal')
    @include('includes.modals.depositories.edit-modal')
@endsection
@section('js')
    @parent
    <script>
        $('.edit-btn').on('click', function() {
            let editBtn = $(this)
            let data = $(this).data('depot-infos')
            $('#edit_name').val(data.name)
            $('#depot_update').attr('action', "{{ route('depositories.update', '') }}/" + data.depot_id)
        })
    </script>
@endsection
