@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="table-responsive d-flex justify-content-center">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>م</th>
                        <th>عنوان المنتج</th>
                        <th>الكمية</th>
                        <th>نوع العملية</th>
                        <th>الجهة</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
