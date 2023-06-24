<div class="modal fade mt-5" id="seacrhModal" tabindex="-1" aria-labelledby="seacrhModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <select class="form-control" style="width:200px" id="search_in">
                    <option value="">إبحث في :</option>
                    @foreach (config('enums.search_in') as $url => $page)
                        <option value="{{ $url }}">{{ $page }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-body">
                <form action="{{ route('items.index') }}" class="text-center" id="search_form">
                    <div class="d-flex mb-3 justify-content-between " style="gap:10px">
                        <select class="form-control" style="width:200px" name="cat_id" id="">
                            <option value="">الأقسام</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="date-filter d-flex justify-content-between">
                            <label class="m-2" for="">من : </label>
                            <input type="date" class="form-control" style="width:45px" name="from">
                            <label class="m-2" for="">إلى : </label>
                            <input type="date" class="form-control" style="width:45px" name="to">
                        </div>
                    </div>
                    <div class="d-flex mb-3 justify-content-between " style="gap:10px">
                        <select class="form-control" style="width:200px" name="depot_id" id="">
                            <option value="">المخازن</option>
                            @foreach ($depots as $depot)
                                <option value="{{ $depot->id }}">{{ $depot->name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control" style="width:200px" name="status" id="">
                            <option value="">حالة المنتج</option>
                            @foreach (config('enums.item_status') as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="search" class="form-control" name="q" placeholder="كلمة البحث">
                    <button class="btn ctm-btn mt-3">بحث</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('js')
    @parent
    <script>
        search_in.onchange = function(){
            search_form.setAttribute('action',this.value)
        }
    </script>
@endsection
