$(document).ready(function () {
    $('.sidebar-menu').tree()
})

$(document).ready(function () {
    $('#date_1 .input-group.date').datepicker({
        todayBtn: "linked",
        orientation: "bottom auto",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
});



$(document).ready(function () {
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});