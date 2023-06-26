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
                                    <th>السعر</th>
                                    <th>الحاله</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($depot->item() as $key => $item)
                                    <tr class="delivered-item" data-index="{{ $key }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ config('enums.item_status')[$item->status] }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($depot->item()->count())
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $depot->item()->links('vendor.pagination.bootstrap-4') }}
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
    <script src="{{asset('js/reports.js')}}"></script>
@endsection
