let pid = $('#pid').val();

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
            $.ajax({
                url: base_url + 'Auth/notify_list',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    'lid': $(this).data('lid'),
                    'pid': pid
                },
                success: res => {
                    alert('success');
                },
                error: res => { },
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