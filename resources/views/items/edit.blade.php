@extends('base')
@section('content')
    @include('includes.nav')
    @include('includes.sidebar')
    <div class="content">
        <div class="custom-form m-auto mt-5" style="max-width:500px">
            <form action="{{ route('item.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 class="text-center mb-2">تعديل المنتج</h4>
                <div class="mb-2">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <label for="title" class="form-label">عنوان المنتج</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $item->title }}"
                        autocomplete="off">
                    @if ($errors->has('title'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="notes" class="form-label">ملاحظات</label>
                    <textarea class="form-control" id="notes" name="notes"> {{ $item->notes }}</textarea>
                    @if ($errors->has('notes'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('notes') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    @isset($categories)
                        @if (count($categories) > 0)
                            <label for="">اختر القسم</label>
                            <select class="form-control mt-2 " name="cat_id" id="edit_cat_id">
                                <option value="{{ $item->category->id ?? '' }}">{{ $item->category->name ?? '' }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('cat_id'))
                                <span class="text-danger text-direction-rtl">{{ $errors->first('cat_id') }}</span>
                            @endif
                        @endif
                    @endisset
                </div>
                <div class="mb-2" id="sub_cat"
                    style="display: @isset($item->subCategory->id) block @else none @endisset">
                    <label for="edit_sub_cat_id" class="form-label">اختر قسم فرعي</label>
                    <select class="form-control" id="edit_sub_cat_id" name="sub_cat_id">
                        @if ($item->subCategory)
                            <option value="{{ $item->subCategory->id }}">{{ $item->subCategory->name }}</option>
                        @endif
                    </select>
                    @if ($errors->has('sub_cat_id'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('sub_cat_id') }}</span>
                    @endif
                </div>
                @if (in_array($user->role, ['super-admin', 'admin']))
                    <div class="mb-2">
                        <label for="depot_id">اختر المخزن</label>
                        <select class="form-control mt-2" name="depot_id" id="depot_id">
                            <option value=""></option>
                            @foreach ($depots as $depot)
                                <option value="{{ $depot->id }}" @if ($depot->id == old('depot_id') || $depot->id == $item->depot_id) selected @endif>
                                    {{ $depot->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('depot_id'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('depot_id') }}</span>
                        @endif
                    </div>
                @endif
                <div class="md-2">
                    <label for="company_id">اختر الشركة</label>
                    <select class="form-control mt-2" name="company_id" id="company_id">
                        <option value=""></option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" @if ($company->id == old('company_id') || $company->id == $item->company_id) selected @endif>
                                {{ $company->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('company_id'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('company_id') }}</span>
                    @endif
                </div>
                <div class="md-2">
                    <label for="status">الحالة</label>
                    <select class="form-control mt-2" name="status" id="status">
                        @foreach (config('enums.item_status') as $key => $item_status)
                            <option value="{{ $key }}" @if ($key == $item->status) selected @endif>
                                {{ $item_status }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('status') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="qty" class="form-label">الكمية</label>
                    <input type="number" class="form-control" id="qty" name="qty" autocomplete="off"
                        value="{{ $item->qty }}">
                    @if ($errors->has('qty'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('qty') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="price" class="form-label">السعر</label>
                    <input type="number" class="form-control" id="price" name="price" autocomplete="off"
                        value="{{ $item->price }}">
                    @if ($errors->has('price'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="created_at" class="form-label">التاريخ</label>
                    <input type="date" class="form-control" id="created_at" name="created_at"
                        value="{{ $item->created_at->format('Y-m-d') }}" autocomplete="off">
                    @if ($errors->has('created_at'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('created_at') }}</span>
                    @endif
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-secondary w-25">حفظ</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        edit_cat_id.onchange = async function() {
            let data = await fetch(`{{ url('sub_categories/${this.value}') }}`);
            data = await data.json();
            if (data.length) {
                sub_cat.style.display = 'block';
                edit_sub_cat_id.innerHTML = `<option value=''></option>`
                data.forEach(item => edit_sub_cat_id.innerHTML +=
                    `<option value='${item.id}'>${item.name}</option>`);
            } else {
                edit_sub_cat_id.innerHTML = '';
                sub_cat.style.display = 'none';
            }
        }
    </script>
@endsection
