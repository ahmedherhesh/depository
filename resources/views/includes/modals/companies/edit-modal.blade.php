<div class="modal fade mt-5" id="updateCompanyModal" tabindex="-1" aria-labelledby="updateCompanyModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mb-2">تعديل شركة</h4>
                <form  method="POST" id="company_update">
                    @csrf
                    <label for="name">اسم الشركة</label>
                    <input type="hidden" name="_method" value="PUT">
                    <input class="form-control mb-3 mt-2" type="text" name="name" value="{{ old('name') }}" id="edit_name">
                    @if ($errors->has('name'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('name') }}</span>
                    @endif
                    <div class="form-group text-center">
                        <button class="btn ctm-btn ">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
