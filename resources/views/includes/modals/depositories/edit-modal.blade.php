<div class="modal fade mt-5" id="updateDepositoryModal" tabindex="-1" aria-labelledby="updateDepositoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mb-2">تعديل مخزن</h4>
                <form method="POST" id="depot_update">
                    @csrf
                    <label for="edit_name">اسم المخزن</label>
                    <input type="hidden" name="_method" value="PUT">
                    <input class="form-control mb-3 mt-3" type="text" name="name" id="edit_name">
                    <div class="form-group text-center">
                        <button class="btn ctm-btn ">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
