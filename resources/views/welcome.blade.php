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
            <div class="ctm-progress-bar p-2 bg-light" count='0'>المنتجات</div>
            <div class="ctm-progress-bar p-2 bg-light" count='0'>الأقسام</div>
            <div class="ctm-progress-bar p-2 bg-light" count='0'>التسليمات</div>
            <div class="ctm-progress-bar p-2 bg-light" count='0'>المرتجعات</div>
            <div class="ctm-progress-bar p-2 bg-light" count='0'>التقارير</div>
        </div>
        @include('includes.empty')
    </div>
@endsection

@section('js')
    <script>
        $('.delete-btn').on('click', function(e) {
            let result = confirm('هل انت متأكد من حذف هذا الكتاب');
            if (!result) e.preventDefault();
        })
    </script>
@endsection
