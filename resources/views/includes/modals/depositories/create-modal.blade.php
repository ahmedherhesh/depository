<div class="modal fade mt-5" id="createDepositoryModal" tabindex="-1" aria-labelledby="createDepositoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mb-2">إضافة مخزن</h4>
                <form action="{{ route('depositories.store') }}" method="POST">
                    @csrf
                    <label for="name">اسم المخزن</label>
                    <input class="form-control mb-3 mt-3" type="text" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger text-direction-rtl">{{ $errors->first('name') }}</span>
                    @endif
                    <div class="form-group text-center">
                        <button class="btn ctm-btn ">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
