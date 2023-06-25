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
        @if ($depots->isNotEmpty())
            <div class="table-responsive d-flex justify-content-center">
                <ul class="nav nav-tabs mb-2" style="width:850px">
                    @foreach ($depots as $key => $depot)
                        <li class="nav-item">
                            <a class="nav-link @if ($key == 0) active @endif"
                                data-index="{{ $key }}" aria-current="page" href="#">{{ $depot->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @foreach ($depots as $key => $depot)
                <div class="ctm-table ctm-table-{{ $key }}">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center m-auto">
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
                                @foreach ($depot->delivery as $key => $delivery)
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
        let navTabs = $('.nav-tabs .nav-link');
        navTabs.on('click', function() {
            navTabs.removeClass('active')
            let self = $(this)
            self.addClass('active')
            $(`.ctm-table`).hide()
            $(`.ctm-table-${self.data('index')}`).show()
        })
    </script>
@endsection
