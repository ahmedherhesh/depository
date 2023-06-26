@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="custom-form m-auto mt-5">
            <h4 class="text-center mb-2">تعديل عملية استرداد منتج</h4>
            <form action="{{ route('returned.item.update',$returned_item) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-2">
                    <label for="recipient_name" class="form-label">اسم الشخص</label>
                    <input type="text" class="form-control" id="recipient_name" name="recipient_name" autocomplete="off"
                        value="{{ old('recipient_name') ?? $returned_item->recipient_name}}">
                    @if ($errors->has('recipient_name'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('recipient_name') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="status">الحالة</label>
                    <select class="form-control mt-2" name="status" id="status">
                        <option value=""></option>
                        @foreach (config('enums.item_status') as $key => $item)
                            <option value="{{ $key }}" @if ($key == old('status') || $returned_item->status == $key ) selected @endif>
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
                        <input class="form-check-input" type="radio" name="in_stock" value="1" id="yes" @if($returned_item->in_stock == 1) checked @endif>
                        <label for="yes" class="ms-4">نعم</label>
                        <input class="form-check-input" type="radio" name="in_stock" value="0" id="no"  @if($returned_item->in_stock == 0) checked @endif>
                        <label for="no">لا</label>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="notes" class="form-label">رأي اللجنة</label>
                    <textarea class="form-control" id="notes" name="notes">{{ old('notes') ?? $returned_item->notes}}</textarea>
                    @if ($errors->has('notes'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('notes') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="qty" class="form-label">الكمية</label>
                    <input type="number" class="form-control" id="qty" name="qty" autocomplete="off"
                        value="{{ old('qty') ?? $returned_item->qty}}">
                    @if ($errors->has('qty'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('qty') }}</span>
                    @endif
                </div>

                <div class="text-center">
                    <button class="btn ctm-btn mt-3">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection
