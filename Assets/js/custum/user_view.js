var res_txt_ddl_options = '';
var win_loc = document.getElementById("callBackLoc").value;
//////////////////////////////////////////////////
///////////     Disable record     //////////////
////////////////////////////////////////////////
function btn_user_disable(e, id) {
    var alertText = '';
    var enable = $(e).data('id');
    if (enable) { alertText = 'Enable'; } else { alertText = 'Disable'; }

    if (id != "" && id != 0) {
        swal({
            title: alertText + " this User! ",
            text: "Are you sure you want to '" + alertText + "' this User ?",
            type: "warning",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "Yes, do it!",
            preConfirm: function (value) {
                return new Promise(function (resolve, reject) {
                    resolve(disable_user_record(e, enable, id))
                })
            }
        });
    }
}
function disable_user_record(e, enable, id) {
    $.ajax({
        url: win_loc + '/disable_user',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'enable_bit': parseInt(enable)
        },
        success: onSuccess_disable_user_record(e, enable),
        error: function (res) {
            console.log(res);
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_disable_user_record(e, enable) {
    return function (res) {
        try {
            if (res.status == 200) {
                if (enable == '1') {
                    $(e).data('id', '0');
                    $(e).removeClass('btn-danger').addClass('btn-primary').find('i').removeClass('iconsminds-close').addClass('simple-icon-check');
                } else {
                    $(e).data('id', '1');
                    $(e).removeClass('btn-primary').addClass('btn-danger').find('i').removeClass('simple-icon-check').addClass('iconsminds-close');
                }
                swal("User", "Updated successfully.", "success");
            } else {
                swal("User", res.msg, "error");
            }
        } catch (e) {
            swal("User", e.message, "error");
        }
    }
}
//////////////////////////////////////////////////
///////////     Delete record     ///////////////
////////////////////////////////////////////////
function btn_user_delete(e, id) {
    console.log(id);
    var alertText = '';
    var deleted = $(e).data('id');
    if (deleted) { alertText = 'Delete'; } else { alertText = 'Restore'; }
    if (id != "" && id != 0) {
        swal({
            title: alertText + " USER !",
            text: "Are you sure you want to '" + alertText + "' this User ?",
            type: "warning",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "Yes, do it!",
            
            preConfirm: function (value) {
                return new Promise(function (resolve, reject) {
                    resolve(delete_record_user(e, deleted, id))
                })
            }
        });
    }
}
function delete_record_user(e, deleted, id) {
    $.ajax({
        url: win_loc + '/delete_user',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'enable_bit': parseInt(deleted == 1 ? 0 : 1),
            'delete_bit': deleted
        },
        success: onSuccess_delete_user_record(e, deleted),
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_delete_user_record(e, deleted) {
    return function (res) {
        try {
            if (res.status == '200') {
                if (deleted == '1') {
                    $(e).data('id', '0');
                    $('.dataTables-grd').DataTable().row($(e).closest('tr')).remove().draw();
                } else {
                    $(e).data('id', '1');
                }
                swal("User", "User deleted successfully!", "success");
            } else {
                swal("User ", res.msg, "error");
            }
        } catch (e) {
            swal("User ", e.message, "error");
        }
    }
}
/////////////////////////////////////////////////
///////////     Helping Methods     ////////////
///////////////////////////////////////////////

function add_new_row_dataTable(e, res) {
    var row = res.result[0];
    var typ = 0;
    var status = '';
    var button_dan_pri = '';

    if (row.enable_bit) { status = ' fa-check '; button_dan_pri = ' btn-primary '; } else { status = ' fa-times '; button_dan_pri = ' btn-danger '; }
    $('.dataTables-grd').DataTable().row.add([
        row.id,
        row.created_at,
        row.title,
        row.page_id,
        row.img,
        '<button class="btn ' + button_dan_pri + ' btn-circle" type="button" onclick="btn_disable(this,' + row.id + ');" data-id="' + (row.enable = 1 ? 0 : 1) + '" href="javascript:void(0);"><i class="fa ' + status + '"></i>' +
        '</button>',
        '<a title="Edit" class="btn btn-primary btn-icon" id="btnEdit" onclick="btn_update_detail(this,' + row.id + ');" href="javascript:void(0);">' +
        '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>' +
        '</a>' +
        ' <a title="Delete" class="btn btn-danger btn-icon" onclick="btn_delete(this,' + row.id + ');" data-id="1" href="javascript:void(0);" >' +
        '<i class="fa fa-trash" aria-hidden="true"></i></a>'
    ]).draw();
}

function permission_disabled(msg) {
    swal('Disabled', msg + ' Permission', 'error');
}

function user_permission_board() {
    // username,email,job_title,password
    var strView = '<hr class="hr-success" />' +
        '<div class="row">' +
        '<div class="col-sm-12 form-horizontal">' +
        '<div class="form-group" id="formInput">' +
        '<div class="row" id="paste">' +

        '<input type="hidden" id="txtID" />' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';
    return strView;
}

function btn_permissions(e, id) {
    swal({
        title: 'User Permission Board',
        html: user_permission_board(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function () {
            var form = '<table>' +
                '<thead>' +
                '<tr>' +
                '<th>Permission</th>' +
                '<th> Status </th>' +
                '</tr>' +
                '</thead>' +
                '<tbody id="tbody">';
            $.ajax({
                url: win_loc + '/get_ajax_permissions',
                method: 'GET',
                contentType: "application/json; charset:utf-8",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function (res) {
                    console.log(res['permissions'][0].id);

                }
            });
            form += '</tbody></table>';
            $('#paste').html(select);
            $('#pageSelect').focus();
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#userName').val() == "" || $('#email').val() == "" || $('#jobTitle').val() == "" || $('#password').val() == "") { reject("Please fill all mendatory(*) fields first!"); }
                resolve([
                    $('#userName').val(),
                    $('#email').val(),
                    $('#jobTitle').val(),
                    $('#password').val()
                ])
            })
        }
    }).then(function (result) {
        swal.showLoading();
        add_record(JSON.parse(JSON.stringify(result)));
    }).catch(swal.noop);
}

function insert_add_view()
{
    return " this is html view ";
}

function isAdmin()
{
    swal('Admin','Unable to edit Admin', 'error');
}
function isSecretary()
{
    swal('Secretary','Unable to edit Secretary', 'error');
}

function is(msg)
{
    swal(msg,'Unable to edit '+msg, 'error');
}