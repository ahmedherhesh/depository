<div class="modal fade mt-5" id="returnItemModal" tabindex="-1" aria-labelledby="returnItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mb-2">استرجاع منتج</h4>
                <form action="{{ route('return.item') }}" method="POST">
                    @csrf
                    <input type="hidden" name="delivery_id" id="delivery_id">
                    <input type="hidden" name="item_id" id="item_id">
                    <div class="mb-2">
                        <label for="recipient_name" class="form-label">اسم الشخص</label>
                        <input type="text" class="form-control" id="recipient_name" name="recipient_name"
                            autocomplete="off" value="{{ old('recipient_name') }}">
                        @if ($errors->has('recipient_name'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('recipient_name') }}</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="status">الحالة</label>
                        <select class="form-control mt-2" name="status" id="status">
                            <option value=""></option>
                            @foreach (config('enums.item_status') as $key => $item)
                                <option value="{{ $key }}" @if ($key == old('status')) selected @endif>
                                    {{ $item }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('status'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="" class="mb-2">إضافة للمخزن</label><br>
                        <div class="border rounded p-2">
                            <input class="form-check-input" type="radio" name="inStock" value="1"
                                id="yes">
                            <label for="yes" class="ms-4">نعم</label>
                            <input class="form-check-input" type="radio" name="inStock" value="0" id="no"
                                checked>
                            <label for="no">لا</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="notes" class="form-label">رأي اللجنة</label>
                        <textarea class="form-control" id="notes" name="notes">{{ old('title') }}</textarea>
                        @if ($errors->has('notes'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('notes') }}</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="qty" class="form-label">الكمية</label>
                        <input type="number" class="form-control" id="qty" name="qty" autocomplete="off"
                            value="{{ old('qty') }}">
                        @if ($errors->has('qty'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('qty') }}</span>
                        @endif
                    </div>
                    
                    <div class="text-center">
                        <button class="btn ctm-btn mt-3">استرداد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
