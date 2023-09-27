@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="custom-form m-auto mt-5">

            <h4 class="text-center mb-2">تعديل عملية تسليم</h4>
            <form action="{{ route('delivery.update', $delivery->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-2">
                    <label for="recipient_name" class="form-label">اسم المستلم</label>
                    <input type="text" class="form-control" id="recipient_name" name="recipient_name" autocomplete="off"
                        value="{{ old('recipient_name') ?? $delivery->recipient_name }}">
                    @if ($errors->has('recipient_name'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('recipient_name') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="side_name" class="form-label">الجهة الموجه إليها</label>
                    <input type="text" class="form-control" id="side_name" name="side_name" autocomplete="off"
                        value="{{ old('side_name') ?? $delivery->side_name }}">
                    @if ($errors->has('side_name'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('side_name') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="notes" class="form-label">ملاحظات</label>
                    <textarea class="form-control" id="notes" name="notes">{{ old('notes') ?? $delivery->notes }}</textarea>
                    @if ($errors->has('notes'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('notes') }}</span>
                    @endif
                </div>
                <div class="mb-2 @if (count($delivery->itemReturn)) d-none @endif">
                    <label for="qty" class="form-label">الكمية</label>
                    <input type="number" class="form-control" id="qty" name="qty" autocomplete="off"
                        value="{{ old('qty') ?? $delivery->qty }}">
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
