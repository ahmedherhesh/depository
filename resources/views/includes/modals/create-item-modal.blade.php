<div class="modal fade" id="createItemModal" tabindex="-1" aria-labelledby="createItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h4 class="text-center mb-2">إضافة منتج</h4>
                    <div class="mb-2">
                        <label for="title" class="form-label">عنوان المنتج</label>
                        <input type="text" class="form-control" id="title" name="title" autocomplete="off"
                            value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="notes" class="form-label">ملاحظات</label>
                        <textarea class="form-control" id="notes" name="notes">{{ old('title') }}</textarea>
                        @if ($errors->has('notes'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('notes') }}</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        @isset($categories)
                            @if (count($categories) > 0)
                                <label for="">اختر القسم</label>
                                <select class="form-control mt-2" name="cat_id" id="cat_id">
                                    <option value=""></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == old('cat_id')) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cat_id'))
                                    <span class="text-danger text-direction-rtl">{{ $errors->first('cat_id') }}</span>
                                @endif
                            @endif
                        @endisset
                    </div>
                    <div class="mb-2 sub-cats">
                        <label for="sub_cat_id" class="form-label">اختر قسم فرعي</label>
                        <select class="form-control" id="sub_cat_id" name="sub_cat_id" id="sub_cat_id"></select>
                        @if ($errors->has('sub_cat_id'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('sub_cat_id') }}</span>
                        @endif
                    </div>

                    <div class="mb-2">
                        <label for="depot_id">اختر المخزن</label>
                        <select class="form-control mt-2" name="depot_id" id="depot_id">
                            <option value=""></option>
                            @foreach ($depots as $depot)
                                <option value="{{$depot->id}}" @if ($depot->id == old('depot_id')) selected @endif>{{$depot->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('depot_id'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('depot_id') }}</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="company_id">اختر الشركة</label>
                        <select class="form-control mt-2" name="company_id" id="company_id">
                            <option value=""></option>
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}" @if ($company->id == old('company_id')) selected @endif>{{$company->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('company_id'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('company_id') }}</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="status">الحالة</label>
                        <select class="form-control mt-2" name="status" id="status">
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
                        <label for="qty" class="form-label">الكمية</label>
                        <input type="number" class="form-control" id="qty" name="qty" autocomplete="off"
                            value="{{ old('qty') }}">
                        @if ($errors->has('qty'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('qty') }}</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="price" class="form-label">السعر</label>
                        <input type="number" class="form-control" id="price" name="price" autocomplete="off"
                            value="{{ old('price') }}">
                        @if ($errors->has('price'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('price') }}</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <label for="date" class="form-label">التاريخ</label>
                        <input type="date" class="form-control" id="date" name="date" autocomplete="off"
                            value="{{ old('date') }}">
                        @if ($errors->has('date'))
                            <span class="text-danger text-direction-rtl">{{ $errors->first('date') }}</span>
                        @endif
                    </div>
                    {{-- <div class="mb-2">
                        <label for="formFile" class="form-label d-block ctm-btn p-1 mt-3 rounded-3">
                            <img src="{{ asset('imgs/upload_file.svg') }}" alt="">
                            <span>اضغط هنا لإختيار الملف</span>
                        </label>
                        <input class="form-control d-none" type="file" id="formFile" name="file">
                    </div>
                    @if ($errors->has('file'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('file') }}</span>
                    @endif --}}

                    <div class="text-center mt-3">
                        <button type="submit" class="btn ctm-btn">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    cat_id.onchange = async function() {
        let data = await fetch(`{{ url('sub_categories/${this.value}') }}`);
        let sub_cats = document.querySelector('.sub-cats');
        data = await data.json();
        if (data.length) {
            sub_cats.style.display = 'block';
            sub_cat_id.innerHTML = `<option value=''></option>`
            data.forEach(item => sub_cat_id.innerHTML += `<option value='${item.id}'>${item.name}</option>`);
        } else {
            sub_cat_id.innerHTML = '';
            sub_cats.style.display = 'none';
        }
    }
</script>
