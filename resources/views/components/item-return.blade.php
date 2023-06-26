<div class="card book mb-2 me-2">
    <div class="book-img bg-light p-2 d-flex justify-content-between">
        <span>{{ $itemReturn->qty }}</span>
        <span>{{ config('enums.item_status')[$itemReturn->status] }}</span>
        @if ($user->id == $itemReturn->user_id || in_array($user->role, ['super-admin', 'admin']))
            <div class="d-flex gap-1">
                <a class="text-secondary" href="{{ route('returned.item.edit', $itemReturn->id) }}" class="edit-btn btn p-0 "><i
                        class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ route('returned.item.destroy', $itemReturn->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="text-secondary delete-btn btn p-0 me-1 " data-type="عملية التسليم" href=""
                        class="delete-btn"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        @endif
    </div>
    <div class="card-body">
        <h5 class="card-title text-center mb-4">{{ $itemReturn->item->title }} </h5>
        <p class="card-text m-0 pb-1 pe-1"><i class="fa-regular fa-user ps-2"></i>{{ $itemReturn->recipient_name }}</p>
        <p class="card-text m-0 p-1 border-top"><i
                class="fa-regular fa-circle-dot ps-2"></i>{{ $itemReturn->delivery->side_name }}
        </p>
        <p class="card-text m-0 p-1 border-top"><i class="fa-regular fa-note-sticky ps-2"></i>{{ $itemReturn->notes }}
        </p>
        <p class="card-text m-0 p-1 border-top border-bottom"><i
                class="fa-regular fa-clock ps-2"></i>{{ $itemReturn->created_at }} </p>
        <div class="text-center pt-2">
            <a href="{{ url('return-to-stock') }}?returned_item_id={{ $itemReturn->id }}&item_id={{ $itemReturn->item_id }}"
                class="btn ctm-btn">تخزين</a>
        </div>
    </div>
</div>
