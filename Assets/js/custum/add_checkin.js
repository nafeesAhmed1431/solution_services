$().ready(function (){
    $('#card').hide();
});
$("#searchForm").submit(function(form) {
    form.preventDefault();

        var lodge = $("#search").val();
        $.ajax({
            type: "POST",
            url: base_url+'Member/search_lodge',
            data: {
                keyword : lodge
            },
            success: function(payload) {
                payload = JSON.parse(payload);
                if (payload.status == 200) {
                    var count  = Object.keys(payload.res).length;
                    load_search_result(payload.res,count);
                } else {
                    swal( '"'+lodge +'" Lodge Not Found', 'Try some other lodge Name ', 'error');
                    $('#card').hide();
                    // setTimeout(function() {
                    //     window.location.href = base_url + "/Admin/events";
                    // }, 3000);
                }
            },
            error: function() {
                swal('CheckIn', 'No Lodge Found', 'error');
                // setTimeout(function() {
                //     window.location.href = base_url + "/Admin/events";
                // }, 3000);
            }
        });
});

function load_search_result(data,count){
var form = '';
for(var i=0; i<count; i++)
{
    form += '<div class="form-row mb-3">'+
                '<a class="btn btn-success btn-block" href="javascript:void(0);" onclick="create_check_in('+data[i].id+')" style="color:white; font-size: 18px;"> '+data[i].title+' <i class="simple-icon-location-pin"></i></a>'+
            '</div>';
}
$('#card').show();
$('#paste').html(form);
}

function create_check_in(id)
{
    swal({
        title: "Check IN",
        text: "Are you sure you want to Checkin this Lodge ?",
        type: "info",
        showLoaderOnConfirm: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: "Yes, do it!",
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                resolve(add_member_checkin(id))
            })
        }
    });
}
function add_member_checkin(id)
{
    $.ajax({
        type: "POST",
        url: base_url+'Member/creat_checkin',
        data: {
            lodge_id : id
        },
        success: function(data) {

            data = JSON.parse(data);
            if (data.status == 200) {
                swal('Checkin', 'You Checked in Successfully', 'success');
                setTimeout(function() {
                    window.location.href = base_url + "Member/Check_In";
                }, 3000);
            } 
            else
            {
                swal('Checkin', 'CheckIn Failed', 'error');
            }
        },
        error: function() {
            swal('Checkin', 'Unexpected Error occured', 'error');
        }
    });
}