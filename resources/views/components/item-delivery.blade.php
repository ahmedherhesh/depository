<div class="card book mb-2 me-2">
    <div class="book-img bg-light p-2 d-flex justify-content-between">
        <span>{{ $delivery->qty - $qty($delivery->itemReturn) }}</span>
        <span>{{ config('enums.item_status')[$delivery->status] }}</span>
        @if ($user->id == $delivery->user_id || in_array($user->role, ['super-admin', 'admin']))
            <div class="d-flex gap-1">
                <a class="text-secondary" href="{{ route('delivery.edit', $delivery->id) }}" class="edit-btn btn p-0 "><i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ route('delivery.delete', $delivery->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="text-secondary delete-btn btn p-0 me-1 " data-type="عملية التسليم" href="" class="delete-btn"><i
                            class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        @endif
    </div>
    <div class="card-body">
        <h5 class="card-title text-center mb-4 ">{{ $delivery->item->title }} </h5>
        <p class="card-text m-0 pb-1 pe-1"><i class="fa-regular fa-user ps-2"></i>{{ $delivery->recipient_name }}</p>
        <p class="card-text m-0 p-1 border-top"><i class="fa-regular fa-circle-dot ps-2"></i>{{ $delivery->side_name }}
        </p>
        <p class="card-text m-0 p-1 border-top"><i class="fa-regular fa-note-sticky ps-2"></i>{{ $delivery->notes }}
        </p>
        <p class="card-text m-0 p-1 border-top border-bottom"><i
                class="fa-regular fa-clock ps-2"></i>{{ $delivery->created_at }} </p>
        <div class="text-center pt-2">
            <button class="btn ctm-btn return-btn" data-bs-toggle="modal" data-bs-target="#returnItemModal"
                data-item-id="{{ $delivery->item->id }}" data-delivery-id="{{ $delivery->id }}">استرداد</button>
        </div>
    </div>
</div>
