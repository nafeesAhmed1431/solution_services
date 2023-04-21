let pid = $('#pid').val();

$(document).ready(function () {

    $('.list-card').each(function () {
        let list_id = $(this).data('lid');
        let percent = list_percentages[list_id]
        if (percent == 100) {
            $(this).find('.list_options').empty().append(`
            <a class="badge badge-success add_document" href="javascript:void(0)" data-list_id="${list_id}">Upload Completion Certificate</a>
            `);
        }
    });

});

$('.upload_file').on('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    formData.append('pid', pid);
    $.ajax({
        type: "POST",
        url: base_url + "Project/add_checklist_doc",
        contentType: false,
        processData: false,
        data: formData,
        success: function (res) {
            Swal.fire({
                title : 'Success',
                text : 'File Uploaded Successfully. Reloading...',
                showCancelButton : false,
                showConfirmButton : false,
                toast : true,
                timer : 1500,
                position : 'top-right',
                icon : 'success'
            }).then(res => {
                location.reload();
            });
        },
        error: function () {
            alert(`error`);
        }
    });
});

$('.notify_checklist').click(function () {
    let clid = $(this).data('clid');
    swal({
        title: "Confirmación",
        text: "¿Está seguro de que desea enviar un correo electrónico de notificación?",
        type: "info",
        showLoaderOnConfirm: true,
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        focusConfirm: false,
        confirmButtonText: "Sí, hazlo !"
    }).then(() => {
        // Show loader in swal dialog
        swal({
            title: "Enviando correo electrónico de notificación",
            text: "Por favor, espere...",
            type: "info",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            onOpen: () => {
                // Send AJAX request to server
                $.ajax({
                    url: base_url + 'Auth/checklist_notify_email',
                    method: 'GET',
                    contentType: "application/json; charset:utf-8",
                    dataType: 'json',
                    data: {
                        'pid': pid,
                        'clid': clid
                    },
                    success: function (res) {
                        // Hide loader in swal dialog and show success toast
                        swal.close();
                        swal('Éxito', 'Correo electrónico de notificación enviado con éxito', 'success');
                    },
                    error: function (res) {
                        // Hide loader in swal dialog and show error toast
                        swal.close();
                        swal("Error inesperado", "Por favor, póngase en contacto con el administrador del sistema.", "error");
                    }
                });
            }
        });
    }).catch(swal.noop);
});

$('.list_notify').on('click', function () {
    swal({
        title: 'Confirmation',
        text: 'Are you Sure to Notify Client',
        showCancelButton: true,
        showConfirmButton: true,
        type: 'question'
    }).then(res => {
        if (res) {
            swal({
                title: "Please wait...",
                text: "Notifying client",
                showConfirmButton: false,
                allowOutsideClick: false,
                onOpen: function () {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: base_url + 'Auth/notify_list',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    'lid': $(this).data('lid'),
                    'pid': pid
                },
                success: res => {
                    swal.close();
                    swal({
                        title: "Success!",
                        text: "The client has been notified.",
                        type: "success",
                        showConfirmButton: true
                    });
                },
                error: res => {
                    swal.close();
                    swal({
                        title: "Error!",
                        text: "There was an error notifying the client.",
                        type: "error",
                        showConfirmButton: true
                    });
                },
            });
        }
    }).catch(swal.noop());;
});

$('.date1').on('change', function () {
    $.ajax({
        url: base_url + 'project/update_date1',
        method: 'GET',
        dataType: 'JSON',
        data: {
            'date': $(this).val(),
            'clid': $(this).data('clid'),
            'pid': pid
        },
        success: res => {
            if (res.status) {
                Swal.fire({
                    title: 'Success',
                    text: `Notify Date set to ${$(this).val()} Successfully`,
                    toast: true,
                    position: 'top-right',
                    timer: 2500,
                    showCancelButton: false,
                    showConfirmButton: false,
                    icon: 'success'
                });
            }
        },
        error: res => { },


    });
});

$('.date2').on('change', function () {
    $.ajax({
        url: base_url + 'project/update_date2',
        method: 'GET',
        dataType: 'JSON',
        data: {
            'date': $(this).val(),
            'clid': $(this).data('clid'),
            'pid': pid
        },
        success: res => {
            if (res.status) {
                Swal.fire({
                    title: 'Success',
                    text: `Document Received Date update Successfully`,
                    toast: true,
                    position: 'top-right',
                    timer: 2500,
                    showCancelButton: false,
                    showConfirmButton: false,
                    icon: 'success'
                });
            }
        },
        error: res => { },


    });
});

$('.comment').on('change', function () {
    $.ajax({
        url: base_url + 'project/update_comment',
        method: 'GET',
        dataType: 'JSON',
        data: {
            'comment': $(this).val(),
            'clid': $(this).data('clid'),
            'pid': pid
        },
        success: res => {
            if (res.status) {
                Swal.fire({
                    title: 'Success',
                    text: `Comment Updated Successfully`,
                    toast: true,
                    position: 'top-right',
                    timer: 2500,
                    showCancelButton: false,
                    showConfirmButton: false,
                    icon: 'success'
                });
            }
        }
    });
});

$('.do_list_notify').on('click', function () {
    swal.fire({
        title: 'Confirmation',
        text: 'Are you sure you want to notify the client?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then(result => {
        if (result.isConfirmed) {
            swal.fire({
                title: "Please wait...",
                text: "Notifying client",
                allowOutsideClick: false,
                didOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: base_url + 'Auth/notify_list',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    'lid': $(this).data('lid'),
                    'pid': pid
                },
                success: res => {
                    swal.fire({
                        title: "Success!",
                        text: "The client has been notified.",
                        icon: "success",
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                },
                error: res => {
                    swal.fire({
                        title: "Error!",
                        text: "There was an error notifying the client.",
                        icon: "error",
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                },
                complete: () => {
                    swal.hideLoading();
                }
            });
        }
    });
});

$(document).on('click', '.add_document', function () {
    let lid = $(this).data('list_id');
    Swal.fire({
        title: 'Upload PDF',
        input: 'file',
        inputAttributes: {
            accept: 'application/pdf',
        },
        showCancelButton: true,
        confirmButtonText: 'Upload',
        showLoaderOnConfirm: true,
        didOpen: function () {
            $('.swal2-file').addClass('form-control');
        },
        preConfirm: function (file) {
            const formData = new FormData();
            formData.append('file', file);
            formData.append('project_id', pid);
            formData.append('list_id', lid);

            $.ajax({
                url: base_url + 'Project/upload_list_completion_certificate',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your PDF has been uploaded.',
                        icon: 'success'
                    });
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Error',
                        text: 'There was an error uploading your PDF: ' + error.responseText,
                        icon: 'error'
                    });
                }
            });
        }
    });
});

