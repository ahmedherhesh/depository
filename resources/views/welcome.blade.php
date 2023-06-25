@extends('base')
@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="progress-section d-flex gap-4 justify-content-center">
            <div class="ctm-progress-bar p-2 bg-light" count='{{ $items_count }}'>المنتجات</div>
            <div class="ctm-progress-bar p-2 bg-light" count='{{ $categories->count() }}'>الأقسام</div>
            <div class="ctm-progress-bar p-2 bg-light" count='{{ $deliveries_count }}'>التسليمات</div>
            <div class="ctm-progress-bar p-2 bg-light" count='{{ $returned_items_count }}'>المرتجعات</div>
            <div class="ctm-progress-bar p-2 bg-light" count='{{ $deliveries_count + $returned_items_count }}'>التقارير
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-5">
            @forelse ($items as $item)
                <x-item :item="$item" />
            @empty
                @include('includes.empty')
            @endforelse
            @include('includes.modals.delivery-item-modal')
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $items->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $('.delete-btn').on('click', function(e) {
            let result = confirm('هل انت متأكد من حذف هذا الكتاب');
            if (!result) e.preventDefault();
        })
    </script>
@endsection
