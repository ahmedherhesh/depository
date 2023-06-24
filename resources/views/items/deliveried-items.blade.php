@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="d-flex justify-content-center align-items-center mt-3">
            @forelse ($deliveries as $delivery)
                <x-item-delivery :delivery="$delivery" :qty="$qty" />
            @empty
                @include('includes.empty')
            @endforelse
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $deliveries->links('vendor.pagination.bootstrap-4') }}
        </div>
        @if (!$deliveries)
            @include('includes.empty')
        @endif
        @include('includes.modals.return-item-modal')
    </div>
@endsection
@section('js')
    @parent
    <script>
        document.querySelectorAll('.return-btn').forEach(el => {
            el.onclick = function() {
                item_id.value = this.getAttribute('data-item-id')
                delivery_id.value = this.getAttribute('data-delivery-id')
            }
        })
    </script>
@endsection
