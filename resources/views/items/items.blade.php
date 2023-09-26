@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="d-flex justify-content-center align-items-center mt-3">
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

