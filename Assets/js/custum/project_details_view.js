let pid = $('#pid').val();

$(document).ready(function () {

    $('.card-list').each(function () {
        let list_id = $(this).data('list_id');
        let percent = list_percentages[list_id]
        if (percent == 100) {
            $(this).find('.col-document').append(`
            <a class="badge badge-success add_document" href="javascript:void(0)" data-list_id="${list_id}">Upload Completion Certificate</a>
            `);
        }
    });

});

function upload_file(element) {

    var doc = element.files[0];
    var p_id = $(element).data('project_id');
    var l_id = $(element).data('list_id');
    var check_id = $(element).data('checklist_id');
    var form = new FormData($('#doc')[0]);

    form.append('doc', doc);
    form.append('project_id', p_id);
    form.append('list_id', l_id);
    form.append('checklist_id', check_id);

    $.ajax({
        type: "POST",
        url: base_url + "Project/add_checklist_doc",
        contentType: false,
        processData: false,
        data: form,
        success: function (res) {
            swal({
                title: "Success",
                text: "Documento del proyecto cargado con éxito",
                type: "success",
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText: "OK",
                onClose: refresh(p_id)
            });
        },
        error: function () {
            alert(`error`);
        }
    });
}

let refresh = (id) => {
    setTimeout(function () {
        window.location.href = base_url + "ProjectDetails/" + id;
    }, 3000);
    // location.reload()
}

let notify = (e) => {
    swal({
        title: "Confirmación",
        text: "¿Está seguro de que desea enviar un correo electrónico de notificación? ?",
        type: "info",
        showLoaderOnConfirm: true,
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        focusConfirm: false,
        confirmButtonText: "Sí, hazlo !",
        preConfirm: function (value) {
            return new Promise(function (resolve, reject) {
                resolve(confirm_notify(e))
            })
        }
    });
}

function confirm_notify(e) {

    var pid = $(e).data('pid');
    var lid = $(e).data('lid');
    var clid = $(e).data('clid');

    $.ajax({
        url: base_url + 'Auth/notify_email',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'pid': pid,
            'lid': lid,
            'clid': clid
        },
        success: function (res) {
            swal('Éxito', 'Correo electrónico de notificación enviado con éxito', 'success');
        },
        error: function (res) {
            console.log(res);
            swal("Error inesperado", "Por favor, póngase en contacto con el administrador del sistema.", "error");
        },
        failure: function (res) {
            swal("Error inesperado", "Por favor, inténtelo de nuevo más tarde.", "error");
        }
    });
}

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
            'clid': $(this).data('checklist_id'),
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
            'clid': $(this).data('checklist_id'),
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
            'clid': $(this).data('checklist_id'),
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
        },
        error: res => { },


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
        didOpen: function() {
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

