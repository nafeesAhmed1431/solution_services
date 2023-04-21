var baseUrl = $('#baseUrl').val();
var listid = $('#list_id').val();

$('.process_status').on('click', function (e) {
    status_text = $(this).data('status') == 1 ? 'Disable' : 'Enable';
    swal({
        title: 'Confirm',
        text: `Are you sure to "${status_text}" this Process.`,
        showConfirmButton: true,
        showCancelButton: true,
        type: 'question'
    }).then(res => {
        $.ajax({
            url: baseUrl + 'Admin/update_process_status',
            method: 'GET',
            dataType: 'JSON',
            data: {
                process_id: $(this).data('process_id'),
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

$('.add_process').on('click', function () {
    swal({
        title: 'New Process',
        html: '<input type="text" id="new_process" class="form-control mb-3" placeholder="Enter Process title here...">',
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if ($('#new_process').val() == "") { reject("Process Name is Required! "); }
                resolve([
                    $('#new_process').val(),
                ])
            })
        }
    }).then(function (result) {
        $.ajax({
            url: baseUrl + 'Admin/add_new_process',
            method: 'GET',
            dataType: 'json',
            data: {
                'title': result[0],
                'lid': listid
            },
            success: resuult => {
                if (resuult.res) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Process Addedd Successfully.',
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
    }).catch(swal.noop);
});

$('.delete_process').on('click', function () {
    swal({
        title: 'Confirm',
        text: 'Are you Sure you want to Delete this Process',
        showCancelButton: true,
        showConfirmButton: true,
        type: 'warning'
    }).then(res => {
        if (res) {
            $.ajax({
                url: baseUrl + 'Admin/delete_process',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    'process_id': $(this).data('process_id')
                },
                success: result => {
                    if (result.res) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Process Deleted Successfully.',
                            toast: true,
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000,
                            position: 'top-right',
                            icon: 'success',
                        })
                            .then(res => {
                                location.reload();
                            });
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

$('.edit_process').on('click', function () {
    let text = $(this).closest('tr').find('td:eq(1)').text();
    let pid = $(this).data('process_id');
    Swal.fire({
        title: 'Update "' + text + '"',
        html: `<input type="text" class="form-control" id="new_title" value="${text}" placeholder="Enter Process name...">`,
        showCancelButton: true,
        showConfirmButton: true,
    }).then(res => {
        if (res.isConfirmed) {
            $.ajax({
                url: baseUrl + 'Admin/udpate_process',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    title: $('#new_title').val(),
                    process_id : pid
                },
                success: result => {
                    if (result.res) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Process updated Successfully.',
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