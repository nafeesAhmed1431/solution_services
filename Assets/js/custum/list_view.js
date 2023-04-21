//////////////////////////////////////////////////
///////////     Update list       ///////////////
////////////////////////////////////////////////

let win_loc = $('#base_url').val();
function btn_update_list_detail(e, id) {
    swal({
        title: 'Update List',
        html: insert_add_view(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function () {
            $('#txtID').val(id);//setting ID here, otherwise would have to pass another parameter to above functions
            var tableObj = $('.dataTables-grd').DataTable();
            var rowObj = $(e).closest('tr');
            $('#list').val(tableObj.row(rowObj).data()[1]);
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#list').val() == "") { reject("Please fill all mendatory(*) fields first!"); }
                resolve([
                    $('#txtID').val(),
                    $('#list').val(),
                ])
            })
        }
    })
        .then(function (result) {
            swal.showLoading();
            swal({
                title: "Update List",
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
                        update_list_detail(e, result);
                });
        })
        .catch(swal.noop);
}
function update_list_detail(e, detail) {
    $.ajax({
        url: win_loc + 'Admin/update_list_details',
        method: 'GET',
        dataType: 'JSON',
        contentType: "application/json; charset:utf-8",
        data: {
            'id': detail[0],
            'title': detail[1],
        },
        success: res => {
            if (res.status == 200) {
                swal({
                    title: 'Success',
                    text: 'List Updated Successfully',
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    type: 'success'
                })
                    .then(callback => callback ? location.reload() : null)
                    .catch(swal.noop);
            }
        },
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
//////////////////////////////////////////////////
///////////     Disable record     //////////////
////////////////////////////////////////////////
function btn_list_disable(e, id) {
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
        url: win_loc + 'Admin/disable_list',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'enable_bit': parseInt(enable)
        },
        success: onSuccess_disable_list_record(e, enable),
        error: function (res) {
            console.log(res);
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_disable_list_record(e, enable) {
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
function btn_delete_list(e, id) {
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
                    resolve(delete_record_list(e, deleted, id));
                })
            }
        });
    }
}
function delete_record_list(e, deleted, id) {
    // alert(`deleted is ${deleted} and id is ${id}`);
    // return;
    $.ajax({
        url: win_loc + 'Admin/delete_list_record',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'enable_bit': 0,
            'delete_bit': deleted
        },
        success: onSuccess_delete_list_record(e, deleted),
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_delete_list_record(e, deleted) {
    return function (res) {
        try {
            if (res.status == '200') {
                if (deleted == '1') {
                    $(e).data('id', '0');
                    $('.dataTables-grd').DataTable().row($(e).closest('tr')).remove().draw();
                } else {
                    $(e).data('id', '1');
                }
                swal("List", "List deleted successfully!", "success");
            } else {
                swal("List ", res.msg, "error");
            }
        } catch (e) {
            swal("List ", e.message, "error");
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
        '<div class="col-sm-2">' +
        '<label class="my-2"> List </label>' +
        '</div>' +
        '<div class="col-sm-10">' +
        '<input type ="text" id="list" class="form-control" placeholder="Enter List Name here !!!">' +
        '</div>' +
        '</div>' +
        '<input type="hidden" id="txtID" />' +
        '</div>' +
        '</div>' +
        '</div>';
    return strView;
}
function add_new_row_dataTable(res) {
    var row = res.result[0];
    var typ = 0;
    var status = '';
    var button_dan_pri = '';
    if (row.enable_bit) {
        status = ' simple-icon-check ';
        button_dan_pri = ' btn-primary ';
    }
    else {
        status = ' iconsminds-close ';
        button_dan_pri = ' btn-danger ';
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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////CheckList Functions //////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// btn_delete_checklist
// btn_update_checklist_detail
// btn_checklist_disable

//////////////////////////////////////////////////
//////////////     Update        ////////////////
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
            $('#txtID').val(id);//setting ID here, otherwise would have to pass another parameter to above functions
            var tableObj = $('.dataTables-grd').DataTable();
            var rowObj = $(e).closest('tr');
            $('#list').val(tableObj.row(rowObj).data()[1]);
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#list').val() == "") { reject("Please fill all mendatory(*) fields first!"); }
                resolve([
                    $('#txtID').val(),
                    $('#list').val(),
                ])
            })
        }
    })
        .then(function (result) {
            swal.showLoading();
            swal({
                title: "Update CheckList",
                text: "Are you sure you want to Update this CheckList?",
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
        url: base_url + 'Project/update_checklist_details',
        method: 'GET',
        dataType: 'JSON',
        contentType: "application/json; charset:utf-8",
        data: {
            'id': detail[0],
            'title': detail[1],
        },
        success: res => {
            if (res.status == 200) {
                swal({
                    title: 'Success',
                    text: 'CheckList Updated Successfully',
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    type: 'success'
                })
                    .then(callback => callback ? location.reload() : null)
                    .catch(swal.noop);
            }
        },
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}

//////////////////////////////////////////////////
//////////////     Delete        ////////////////
////////////////////////////////////////////////

let btn_delete_checklist = (e, id) => {
    if (id !== 0 || id !== '') {
        swal({
            title: 'Confirm',
            text: 'Are you sure you want to delete this checklist',
            showCancelButton: true,
            cancelButtonText: 'Cancel it',
            cancelButtonColor: 'tomato',
            showConfirmButton: true,
            confirmButtonText: 'Delete it',
            type: 'warning'
        }).then(res => {
            if (res) {
                $.ajax({
                    url: base_url + 'Project/delete_checklist',
                    method: 'GET',
                    dataType: 'JSON',
                    contentType: "application/json; charset:utf-8",
                    data: {
                        'id': id,
                        'delete_bit': 1,
                        'enable_bit': 0
                    },
                    success: res => {
                        if (res.status == 200) {
                            swal({
                                title: 'Deleted',
                                text: 'Checklist Deleted Successfully',
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                type: 'success'
                            })
                                .then(res => {
                                    res ? location.reload() : null;
                                }).catch(swal.noop);
                        }
                    },
                    error: res => { swal('Failed', 'Unable to Delete checklist', 'error') },
                    failure: res => { swal('Failure', 'Unable to delete checklist', 'error') }
                });
            }
        }).catch(swal.noop);
    }
}

let btn_checklist_disable = (e, id) => {
    let set = $(e).data('set');
    let text = set ? 'Enable' : 'Disable';
    if (id !== 0 || id !== '') {
        swal({
            title: 'Confirm',
            text: 'Are you sure you want to ' + text + ' this checklist',
            showCancelButton: true,
            cancelButtonText: 'Cancel it',
            cancelButtonColor: 'tomato',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            type: 'warning'
        }).then(res => {
            if (res) {
                $.ajax({
                    url: base_url + 'Project/manage_checklist',
                    method: 'GET',
                    dataType: 'JSON',
                    contentType: "application/json; charset:utf-8",
                    data: {
                        'id': id,
                        'enable_bit': set
                    },
                    success: res => {
                        if (res.status == 200) {
                            swal({
                                title: text,
                                text: 'Checklist ' + text + ' Successfully',
                                showCancelButton: false,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                type: 'success'
                            })
                                .then(res => {
                                    res ? location.reload() : null;
                                }).catch(swal.noop);
                        }
                    },
                    error: res => { swal('Failed', 'Unable to Delete checklist', 'error') },
                    failure: res => { swal('Failure', 'Unable to delete checklist', 'error') }
                });
            }
        }).catch(swal.noop);
    }
}

//////////////////////////////////////////////////
//////////////     checklist        /////////////
////////////////////////////////////////////////

let add_new_checklist = id => {
    swal({
        title: 'Add New check List',
        html: insert_add_view(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function () {
            $('#list').focus();
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#list').val() == "") { reject("Please fill all mendatory(*) fields first!"); }
                resolve([$('#list').val()])
            })
        }
    })
        .then(result => { swal.showLoading(); add_checklist_record(result, id) })
        .catch(swal.noop);

}

function add_checklist_record(detail, id) {
    $.ajax({
        url: base_url + 'Project/add_new_checklist',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'JSON',
        data: {
            'list_id': id,
            'title': detail[0]
        },
        success: res => {
            if (res.status == 200) {
                swal({
                    title: 'Success',
                    text: 'New Check List Added Successfully',
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    type: 'success'
                })
                    .then(res => {
                        if (res) {
                            location.reload();
                        }
                    }).catch(swal.noop);
            }
        },
        error: res => swal("Upexpected Error", "Please contact system administrator.", "error"),
        failure: res => swal("Upexpected Error", "Please contact system administrator.", "error"),
    });
}

//////////////////////////////////////////////////
//////////////     lists            /////////////
////////////////////////////////////////////////

let add_list = () => {
    swal({
        title: 'Add New List',
        html: insert_add_view(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function () {
            $('#list').focus();
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#list').val() == "") { reject("Please fill all mendatory(*) fields first!"); }
                resolve([$('#list').val()])
            })
        }
    })
        .then(result => { swal.showLoading(); add_list_record(result) })
        .catch(swal.noop);

}

function add_list_record(detail) {
    $.ajax({
        url: base_url + 'Admin/add_new_list',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'JSON',
        data: {
            'title': detail[0]
        },
        success: res => {
            if (res.status == 200) {
                swal({
                    title: 'Success',
                    text: 'New List Added Successfully',
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    type: 'success'
                })
                    .then(res => {
                        if (res) {
                            location.reload();
                        }
                    }).catch(swal.noop);
            }
        },
        error: res => swal("Upexpected Error", "Please contact system administrator.", "error"),
        failure: res => swal("Upexpected Error", "Please contact system administrator.", "error"),
    });
}