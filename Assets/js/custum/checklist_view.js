alert($('#base_url').val());
//////////////////////////////////////////////////
///////////     Update record     ///////////////
////////////////////////////////////////////////

function btn_update_checklist_detail(e, id) {
    swal({
        title: 'Update List',
        html: insert_add_view(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function () {
            var tableObj = $('.dataTables-grd').DataTable();
            var rowObj = $(e).closest('tr');
            $('#checklist').val(tableObj.row(rowObj).data()[1]);
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#list').val() == "") { reject("Please fill all mendatory(*) fields first!"); }
                resolve([
                    $('#checklist').val(),
                ])
            })
        }
    })
        .then(function (result) {
            swal.showLoading();
            swal({
                title: "Update CheckList",
                text: "Are you sure you want to Update this List?",
                icon: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                closeOnConfirm: false,
                button: {
                    text: "Yes!",
                    value: true,
                    visible: true,
                    closeModal: false
                }, defeat: true
            })
                .then((value) => {
                    if (value)
                        update_checklist_detail(e, result);
                });
        })
        .catch(swal.noop);
}
function update_checklist_detail(e, detail) {
    $.ajax({
        url: win_loc + '/update_list_details',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        data: {
            'title': detail[1],
        },
        success: onSuccess_update_checklist_detail(e),
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_update_checklist_detail(e) {
    return function (res) {
        try {
            res = JSON.parse(res);
            if (res.status == 200) {
                $('.dataTables-grd').DataTable().row($(e).closest('tr')).remove().draw();
                add_new_row_dataTable(e, res);
                swal("List Record", "Updated successfully.", "success");
            } else {
                swal("List", res.msg, "error");
            }
        } catch (e) {
            swal("List", e.message(), "berror");
        }
    }
}

//////////////////////////////////////////////////
///////////     Add New Record     //////////////
////////////////////////////////////////////////
function add_checklist(e) {
    swal({
        title: 'New CheckList',
        html: '<input type="text" id="new_checklist" class="form-control mb-3" placeholder="Enter Check List name here">',
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#new_checklist').val() == "") { reject("Please fill all mendatory(*) fields first!"); }
                resolve([
                    $('#new_checklist').val(),
                ])
            })
        }
    }).then(function (result) {
        swal.showLoading();
        add_checklist_record(JSON.parse(JSON.stringify(result)));
    }).catch(swal.noop);

}
function add_checklist_record(detail, url) {
    $.ajax({
        url: win_loc + 'Admin/add_new_checklist',
        method: 'GET',
        dataType: 'json',
        data: {
            'title': detail[0],
        },
        success: onSuccess_add_checklist_record,
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_add_checklist_record(res) {
    try {
        if (res.status == 200) {
            add_new_row_dataTable(null, res);
            swal(" List ", "Data Added Successfully!", "success");
        } else {
            swal("List ", res.msg, "error");
        }
    } catch (e) {
        swal("List", e.message, "error");
    }
}
//////////////////////////////////////////////////
///////////     Disable record     //////////////
////////////////////////////////////////////////
function btn_checklist_disable(e, id) {
    var alertText = '';
    var enable = $(e).data('id');
    if (enable) { alertText = 'Enable'; } else { alertText = 'Disable'; }

    if (id != "" && id != 0) {
        swal({
            title: alertText + " List!",
            text: "Are you sure you want to '" + alertText + "' this List ?",
            type: "warning",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "Yes, do it!",
            preConfirm: function (value) {
                return new Promise(function (resolve, reject) {
                    resolve(disable_record(e, enable, id))
                })
            }
        });
    }
}
function disable_record(e, enable, id) {
    $.ajax({
        url: win_loc + '/disable_checklist',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'enable_bit': parseInt(enable)
        },
        success: onSuccess_disable_checklist_record(e, enable),
        error: function (res) {
            console.log(res);
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_disable_checklist_record(e, enable) {
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
                swal("List Details", "Updated successfully.", "success");
            } else {
                swal("List", res.msg, "error");
            }
        } catch (e) {
            swal("List", e.message, "error");
        }
    }
}
//////////////////////////////////////////////////
///////////     Delete record     ///////////////
////////////////////////////////////////////////
function btn_delete_checklist(e, id) {
    var alertText = '';
    var deleted = $(e).data('id');
    alertText = 'Delete';
    if (id != "" && id != 0) {
        swal({
            title: alertText + " List Record!",
            text: "Are you sure you want to '" + alertText + "' this List?",
            type: "warning",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "Yes, do it!",
            preConfirm: function (email) {
                return new Promise(function (resolve, reject) {
                    resolve(delete_record_checklist(e, deleted, id));
                })
            }
        });
    }
}
function delete_record_checklist(e, deleted, id) {
    // alert(`deleted is ${deleted} and id is ${id}`);
    // return;
    $.ajax({
        url: win_loc + '/delete_checklist_record',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'enable_bit': 0,
            'delete_bit': deleted
        },
        success: onSuccess_delete_checklist_record(e, deleted),
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_delete_checklist_record(e, deleted) {
    return function (res) {
        try {
            if (res.status == '200') {
                if (deleted == '1') {
                    $(e).data('id', '0');
                    $('.dataTables-grd').DataTable().row($(e).closest('tr')).remove().draw();
                } else {
                    $(e).data('id', '1');
                }
                swal("CheckList", "CheckList deleted successfully!", "success");
            } else {
                swal("CheckList ", res.msg, "error");
            }
        } catch (e) {
            swal("CheckList ", e.message, "error");
        }
    }
}

/////////////////////////////////////////////////
///////////     Helping Methods     ////////////
///////////////////////////////////////////////
function insert_add_view() {
    var strView = '<hr class="hr-success" />' +
        '<div class="row">' +
        '<div class="col-sm-12 form-horizontal">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        '<input type ="text" id="checklist" class="form-control" placeholder="Enter Check List Name here !!!">' +
        '</div>' +
        '</div>' +
        '<input type="hidden" id="txtID" />' +
        '</div>' +
        '</div>' +
        '</div>';
    return strView;
}
function add_new_row_dataTable(e, res) {
    var row = res.result[0];
    var typ = 0;
    var status = '';
    var button_dan_pri = '';
    if (row.enable_bit) {
        status = ' simple-icon-check '; button_dan_pri = ' btn-primary ';
    }
    else {
        status = ' iconsminds-close '; button_dan_pri = ' btn-danger ';
    }

    $('#grd').DataTable().row.add([
        row.id,
        row.title,
        '<button class="btn ' + button_dan_pri + ' btn-circle" type="button" onclick="btn_disable(this,' + row.id + ');" data-id="' + (row.enable = 1 ? 0 : 1) + '" href="javascript:void(0);"><i class="' + status + '"></i></button>',
        '<a title="Edit" class="btn btn-success btn-icon" id="btnEdit" onclick="btn_update_detail(this,' + row.id + ');" href="javascript:void(0);"><i class="simple-icon-note" aria-hidden="true"></i>' + '</a>' +
        '<a title="Delete" class="btn btn-danger btn-icon" onclick="btn_delete(this,' + row.id + ');" data-id="1" href="javascript:void(0);" ><i class="simple-icon-trash" aria-hidden="true"></i></a>' +
        '<a title="View" class="btn btn-icon" data-id="1" href="' + win_loc + '/checklist_details/' + row.id + ' "><i class="simple-icon-eye" aria-hidden="true"></i></a>'
    ]).draw();
}

function permission_disabled(msg) {
    swal(msg, 'You donot have permission to ' + msg, 'error');
}