<form action="{{ $action }}" class="date-filter mt-4 d-flex justfy-content-center  gap-2 m-auto ">
    @if (request()->inventory)
        <input type="hidden" name="inventory" value="1">
    @endif
    <div class="d-flex justify-content-center">
        <label for="from" class="mb-1 w-25">من:</label>
        <input class="form-control w-75" name="from" id="from" type="date" min="2000-01-01">
    </div>
    <div class="d-flex justify-content-center">
        <label for="to" class="mb-1 w-25">إلى:</label>
        <input class="form-control w-75" name="to" id="to" type="date" min="2000-01-01">
    </div>
    <button style="opacity: 0"></button>
</form>
