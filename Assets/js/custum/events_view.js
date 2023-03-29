$(document).ready(function() {
    $('.event_bit').hide();
});

function hide_calendar() {
    $('.calendar_bit').hide();
    $('.event_bit').show();

}

function hide_events() {
    $('.event_bit').hide();
    $('.calendar_bit').show();
}

$("#eventForm").submit(function(event) {
    event.preventDefault();
    var elements = ['#title', '#desc', '#start','#startTime', '#end','#endTime'];
    if ($('#title').val() == "" || $('#desc').val() == "" || $('#start').val() == "" || $('#end').val() == "" || $('#startTime').val() == "" || $('#endTime').val() == "") {
        for (var i = 0; i < 6; i++) {
            if ($(elements[i]).val() == "") 
            {
                $(elements[i]).focus();
                break;
            }
        }
    } else {

        var form = $("#eventForm");
        if ($('#submit').data('url') == 1) {
            var url = base_url + '/Admin/update_event';
        } else {
            var url = base_url + '/Admin/add_event';
        }
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data) {
                data = JSON.parse(data);
                if (data.status == 200) {
                    swal('Event', 'Event Added Successfully', 'success');
                    setTimeout(function() {
                        window.location.href = base_url + "/Admin/events";
                    }, 3000);

                } 
                else 
                {
                    swal('Event', 'Unexpected Error', 'error');
                    setTimeout(function() {
                        window.location.href = base_url + "/Admin/events";
                    }, 3000);
                }
            },
            error: function() {
                // swal('Event', 'Unexpected Error', 'error');
                // setTimeout(function() {
                //     window.location.href = base_url + "/Admin/events";
                // }, 3000);
            }
        });
    }
});