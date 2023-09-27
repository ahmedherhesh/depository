@extends('base')
@section('css')
    <style>
        .table-active {
            display: none
        }

        .nav-tabs .nav-link {
            color: #000
        }

        .nav-tabs .nav-link.active {
            font-weight: bold
        }

        .ctm-table {
            display: none
        }

        .ctm-table:nth-of-type(2) {
            display: block
        }
    </style>
@endsection
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <x-date-filter action="{{ route('reports') }}" />

        @if ($depositories->isNotEmpty())
            <div class="table-responsive">
                <ul class="nav nav-tabs mb-2 m-auto" style="width:850px">
                    @foreach ($depositories as $key => $depot)
                        <li class="nav-item">
                            <a class="nav-link @if ($key == 0) active @endif"
                                data-index="{{ $key }}" aria-current="page" href="#">{{ $depot->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @foreach ($depositories as $key => $depot)
                <div class="ctm-table ctm-table-{{ $key }}">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center m-auto">
                            <thead class="table-dark">
                                <tr>
                                    <th>م</th>
                                    <th>عنوان المنتج</th>
                                    <th>الكمية</th>
                                    <th>نوع العملية</th>
                                    <th>الحالة</th>
                                    <th>الجهة</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($depot->delivery() as $key => $delivery)
                                    <tr class="delivered-item" data-index="{{ $key }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $delivery->item->title }}</td>
                                        <td>{{ $delivery->qty }}</td>
                                        <td>تسليمات</td>
                                        <td>{{ config('enums')['item_status'][$delivery->status] }}</td>
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
                                                <td>{{ config('enums')['item_status'][$returned_item->status] }}</td>
                                                <td>{{ $delivery->side_name }}</td>
                                                <td>{{ $returned_item->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @if ($depot->delivery()->count())
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $depot->delivery()->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    @endif
                </div>
            @endforeach
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
    <script src="{{ asset('js/reports.js') }}"></script>
@endsection
