<div class="card book mb-2 me-2">
    <div class="book-img bg-light p-2 d-flex justify-content-between">
        <h5 class="card-title w-80">{{ $delivery->item->title }} </h5>
        <span>{{ $delivery->qty -  $qty($delivery->itemReturn)  }}</span>
    </div>
    <div class="card-body">
        <p class="card-text m-0 pb-1 pe-1"><i class="fa-regular fa-user ps-2"></i>{{ $delivery->recipient_name }}</p>
        <p class="card-text m-0 p-1 border-top"><i class="fa-regular fa-circle-dot ps-2"></i>{{ $delivery->side_name }}</p>
        <p class="card-text m-0 p-1 border-top"><i class="fa-regular fa-note-sticky ps-2"></i>{{ $delivery->notes }} </p>
        <p class="card-text m-0 p-1 border-top border-bottom"><i class="fa-regular fa-clock ps-2"></i>{{ $delivery->created_at }} </p>
        <div class="text-center pt-2">
            <button class="btn ctm-btn return-btn" data-bs-toggle="modal" data-bs-target="#returnItemModal"
                data-item-id="{{ $delivery->item->id }}" data-delivery-id="{{ $delivery->id }}">استرداد</button>
        </div>
    </div>
</div>
