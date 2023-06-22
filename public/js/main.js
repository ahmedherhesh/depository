$('.delete-btn').on('click', function (e) {
    let result = confirm(`هل انت متأكد من حذف هذا ${$(this).data('type')}`);
    if (!result) e.preventDefault();
})