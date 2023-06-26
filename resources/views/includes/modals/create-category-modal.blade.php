<div class="modal fade mt-5" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    @isset($categories)
                        @if (count($categories))
                            <label for="">اختر القسم الرئيسي</label>
                            <select class="form-control mt-2" name="parent_id" id="">
                                <option value=""></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('parent_id'))
                                <span class="text-danger text-direction-rtl">{{ $errors->first('parent_id') }}</span>
                            @endif
                        @endif
                    @endisset
                    @if (in_array($user->role, ['super-admin', 'admin']))
                        <div class="mb-2">
                            <label for="depot_id">اختر المخزن</label>
                            <select class="form-control mt-2" name="depot_id" id="depot_id">
                                <option value=""></option>
                                @foreach ($depots as $depot)
                                    <option value="{{ $depot->id }}"
                                        @if ($depot->id == old('depot_id')) selected @endif>{{ $depot->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('depot_id'))
                                <span class="text-danger text-direction-rtl">{{ $errors->first('depot_id') }}</span>
                            @endif
                        </div>
                    @endif
                    <div class="form-group mt-3">
                        <label for="">اسم القسم</label>
                        <input type="text" class="form-control mt-2" name="name" autocomplete="off">
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('name') }}</span>
                    @endif
                    <div class="form-group text-center">
                        <button class="btn ctm-btn mt-3">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
