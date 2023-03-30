var baseUrl = $('#base_url').val();
var list_id = $('#list_id').val();

$('.edit_checklist').on('click', function () {
    var text = $(this).closest('tr').find('td:eq(1)').text();
    var clid = $(this).data('clid');
    Swal.fire({
        title: 'Update Checklist',
        html: `<input type="text" class="form-control mb-3" id="new_title" value="${text}" placeholder="Enter Checklist Name">
               <select id="process" class="form-control"></select>`,
        showCancelButton: true,
        showConfirmButton: true,
        onOpen: function () {
            $.ajax({
                url: baseUrl + 'Admin/pre_edit_checklist',
                method: 'GET',
                dataType: 'JSON',
                data: { clid: clid },
                success: res => {
                    if (res.data) {
                        let options = '';
                        for (let i of res.data)
                            options += `<option value="${i.id}" ${res.pid == i.id ? "selected" : ""}>${i.title}</option>`;
                        $('#process').append(options);
                    }
                }
            });
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#new_title').val() == "" || $('#process').val() == "") {
                    reject("Please fill in all required fields!");
                } else {
                    resolve([$('#new_title').val(), $('#process').val()]);
                }
            })
        }
    }).then(res => {
        if (res.isConfirmed) {
            $.ajax({
                url: baseUrl + 'Admin/udpate_checklist',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    title: res.value[0],
                    process_id: res.value[1],
                    clid: clid
                },
                success: result => {
                    if (result.res) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Checklist updated Successfully.',
                            toast: true,
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000,
                            position: 'top-right',
                            icon: 'success',
                        }).then(res => {
                            location.reload();
                        }).catch(swal.noop());
                    } else {
                        sweet_toast('Warning', 'Something went Wrong Please Contact System Administrator', 'warning');
                    }
                },
                error: res => {
                    sweet_toast('Warning', 'Something went Wrong Please Contact System Administrator', 'warning');
                }
            });
        }
    }).catch(swal.noop());
});

function add_checklist(e) {
    swal({
        title: 'New Check List',
        html: `<input type="text" id="new_checklist" class="form-control mb-3" placeholder="Enter Check List name here">
                <select id="process" class="form-control"></select>`,
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        onOpen: function () {
            $.ajax({
                url: baseUrl + 'Admin/get_process',
                method: 'GET',
                dataType: 'JSON',
                success: res => {
                    if (res.data) {
                        let options = '';
                        for (let i of res.data)
                            options += `<option value="${i.id}">${i.title}</option>`;
                        $('#process').append(options);
                    }
                },
                error: res => {
                    sweet_toast('Info', 'Something went wrong. Please try again later.', 'info')
                }
            });
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#new_checklist').val() == "" || $('#process').val() == "") {
                    reject("Please fill in all required fields!");
                } else {
                    resolve([$('#new_checklist').val(), $('#process').val()]);
                }
            })
        }
    }).then(function (result) {

        $.ajax({
            url: baseUrl + 'Admin/add_new_checklist',
            method: 'GET',
            dataType: 'json',
            data: {
                'title': result[0],
                'process_id': result[1],
                'list_id': list_id
            },
            success: resuult => {
                if (resuult.res) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Checklist Added Successfully.',
                        toast: true,
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1000,
                        position: 'top-right',
                        icon: 'success',
                    }).then(res => {
                        location.reload();
                    }).catch(swal.noop());
                } else {
                    sweet_toast('Warning', 'Something went Wrong Please Contact System Administrator', 'warning');
                }
            },
            error: res => {
                sweet_toast('Warning', 'Something went Wrong Please Contact System Administrator', 'warning');
            }
        });
    }).catch(swal.noop);
}

$('.btnDelete').on('click', function () {
    Swal.fire({
        title: 'Confirm',
        text: 'Are you Sure you want to Delete this Checklist',
        showCancelButton: true,
        showConfirmButton: true,
        icon: 'warning'
    }).then(res => {
        if (res.isConfirmed) {
            $.ajax({
                url: baseUrl + 'Admin/delete_checklistlist',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    'id': $(this).data('clid')
                },
                success: result => {
                    if (result.res) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Checklist Deleted Successfully.',
                            toast: true,
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000,
                            position: 'top-right',
                            icon: 'success',
                        }).then(res => {
                            location.reload();
                        }).catch(swal.noop());
                    } else {
                        sweet_toast('Warning', 'Something went Wrong Please Contact System Administrator', 'warning');
                    }
                },
                error: res => {
                    sweet_toast('Warning', 'Something went Wrong Please Contact System Administrator', 'warning');
                },
            });
        }
    }).catch(swal.noop());
});

$('.checklist_status').on('click', function (e) {
    status_text = $(this).data('status') == 1 ? 'Disable' : 'Enable';
    swal({
        title: 'Confirm',
        text: `Are you sure to "${status_text}" this Checklist.`,
        showConfirmButton: true,
        showCancelButton: true,
        type: 'question'
    }).then(res => {
        $.ajax({
            url: baseUrl + 'Admin/update_checklist_status',
            method: 'GET',
            dataType: 'JSON',
            data: {
                clid: $(this).data('clid'),
                status: $(this).data('status')
            },
            success: ret => {
                if (ret.res) {
                    sweet_toast('Success', ret.status == 1 ? 'Enabled' : 'Disabled', 'success');
                    $(this).data('status', ret.status);
                    if (ret.status) {
                        $(this).find('i').toggleClass('simple-icon-check iconsminds-close');
                    } else {
                        $(this).find('i').toggleClass('simple-icon-check iconsminds-close');
                    }
                }
            },
            error: res => {
                sweet_toast('Warning', 'Something went Wrong Please Contact System Administrator', 'warning');
            }

        });
    }).catch(swal.noop());
});

function sweet_toast(title, msg, type) {
    Swal.fire({
        title: title,
        text: msg,
        toast: true,
        showCancelButton: false,
        showConfirmButton: false,
        timer: 1000,
        icon: type,
        position: 'top-right'
    });
}