$(document).ready(function() {
    get_events();
});

function get_events() {
    $.ajax({
        url: base_url + '/Admin/get_events',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        success: function(res) { load_calendar() },
        error: function(res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function(res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}

function load_calendar() {
    var r_id = $('#r_id').val();
    $(".calendar").fullCalendar({
        header: {
            left: 'prev, next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        themeSystem: "bootstrap4",
        height: "auto",
        buttonText: {
            today: "Today",
            month: "Month",
            week: "Week",
            day: "Day",
            list: "List"
        },
        bootstrapFontAwesome: {
            prev: " simple-icon-arrow-left",
            next: " simple-icon-arrow-right",
            prevYear: "simple-icon-control-start",
            nextYear: "simple-icon-control-end"
        },
        eventSources: [
            { url: base_url + '/Admin/get_events' }
        ],
        eventClick: function(event) {
            if ((event.created_by == uId && event.lodge_id == lId)||(uId == 1)) {
                swal({
                    title: 'Event Details',
                    html: load_sweetAlert(event),
                    showCancelButton: false,
                    showConfirmButton: false
                })
            } else {
                swal({
                    title: 'Event Details',
                    html: info_sweetAlert(event),
                    showCancelButton: false,
                    showConfirmButton: true,
                })
            }
        }
    });
}


function load_sweetAlert(event) {
    var title = { id: event.id, title: event.title, description: event.description, start: event.start['_i'], end: event.end['_i'], lodge_id: event.lodge_id };

    var strView = '<hr class="hr-success" />' +
        '<div class="col-sm-12 form-horizontal">' +
        '<div class="dashboard-small-chart">' +
        '<p class="lead color-theme-1 mb-1 id="cTitle" value">' + title.title +'</p>' +
        '<p class="mb-0 my-1 label id="cStart" ">Start Date : ' + title.start + '</p>' +
        '<p class="mb-0 my-1 label id="cEnd" ">End Date : ' + title.end + '</p>' +
        '<br>' +
        '<a class="btn btn-success mr-3" href="' + base_url + '/Admin/get_event/' + title.id + '">Edit</a>' +
        '<button id="delete_event" data-id=' + title.id + ' class="btn btn-danger ">Delete</button>' +
        '<button id="close_alert" class="btn btn-secondary ml-3">Cancel</button>' +
        '</div>' +
        '</div>';
    return strView;
}


function info_sweetAlert(event) {
    var title = { id: event.id, title: event.title, description: event.description, start: event.start['_i'], end: event.end['_i'], lodge_id: event.lodge_id };

    var strView = '<hr class="hr-success" />' +
        '<div class="col-sm-12 form-horizontal">' +
        '<div class="dashboard-small-chart">' +
        '<p class="lead form-control round_corner color-theme-1 mb-1 id="cTitle" value">' + title.title +'</p>' +
        '<p class=" mb-1 mt-3 id="cStart" "><strong style="color:red">Start Date : </strong>' + title.start + '</p>' +
        '<p class=" mb-1 id="cEnd" "><strong style="color:red">End Date : </strong> ' + title.end + '</p>' +
        '<hr>' +
        '</div>' +
        '</div>';
    return strView;
}


$(document).on('click', '#close_alert', function() {
    swal.close();
});

$(document).on('click', '#delete_event', function() {
    var id = $('#delete_event').data('id');
    swal({
        title: "Delete Event !",
        text: "Are you sure you want to Delete this Event ?",
        type: "warning",
        showLoaderOnConfirm: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: "Yes, do it!",
        preConfirm: function() {
            return new Promise(function(resolve, reject) {
                resolve(delete_record_event(id))
            })
        }
    });
});

function delete_record_event(id) {

    $.ajax({
        url: base_url + '/Admin/delete_event',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'enable_bit': 0,
            'delete_bit': 1
        },
        success: function(res) {
            if (res.status == 200) {
                swal('Event', 'Event Deleted Successfully', 'success');
                setTimeout(function() {
                    window.location.href = base_url + "/Admin/events";
                }, 3000);
            }
        },
        error: function(res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function(res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}