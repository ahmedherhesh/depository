@extends('base')
@section('css')
    <style>
        .table-active {
            display: none
        }
    </style>
@endsection
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        @if ($deliveries->isNotEmpty())
            <div class="table-responsive d-flex justify-content-center">
                <table class="table table-bordered align-middle text-center mt-5">
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
                        @foreach ($deliveries as $key => $delivery)
                            <tr class="delivered-item" data-index="{{ $key }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $delivery->item->title }}</td>
                                <td>{{ $delivery->qty }}</td>
                                <td>تسليمات</td>
                                <td>{{ $delivery->side_name }}</td>
                                <td>{{ $delivery->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @isset($delivery->itemReturn)
                                @foreach ($delivery->itemReturn as $returned_item)
                                    <tr class="table-active returned-item-{{ $key }}">
                                        <td>#</td>
                                        <td>{{ $returned_item->item->title }}</td>
                                        <td>{{ $returned_item->qty }}</td>
                                        <td>مرتجعات</td>
                                        <td>{{ $delivery->side_name }}</td>
                                        <td>{{ $returned_item->date }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            @include('includes.empty')
        @endif
    </div>
@endsection

@section('js')
    @parent
    <script>
        $('.delivered-item').on('click', function() {
            $(`.returned-item-${$(this).data('index')}`).toggle()
        })
    </script>
@endsection
