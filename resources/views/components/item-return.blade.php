<div class="card book mb-2 me-2">
    <div class="book-img bg-light p-2 d-flex justify-content-between">
        <h5 class="card-title w-80">{{ $itemReturn->item->title }} </h5>
        <span>{{ $itemReturn->qty }}</span>
    </div>
    <div class="card-body">
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
