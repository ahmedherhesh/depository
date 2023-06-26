let navTabs = $(".nav-tabs .nav-link");
navTabs.on("click", function () {
    navTabs.removeClass("active");
    let self = $(this);
    self.addClass("active");
    $(`.ctm-table`).hide();
    $(`.ctm-table-${self.data("index")}`).show();
});

let params = getParams();
let strParams = "";
for (key in params) {
    if (key == "page") continue;
    strParams += `&${key}=${params[key]}`;
}
$(".pagination .page-item a.page-link").each(function (index) {
    $(this).attr("href", $(this).attr("href") + strParams);
});
