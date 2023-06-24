@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="d-flex justify-content-center align-items-center mt-3">
            @forelse ($returnedItems as $item)
                <x-item-return :itemReturn="$item" />
            @empty
                @include('includes.empty')
            @endforelse
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{ $returnedItems->links('vendor.pagination.bootstrap-4') }}
        </div>
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
