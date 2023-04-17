var win_loc = $('#callBackLoc').val();

$(document).ready(function () {
    $('#allProjectsTable').DataTable({
        suppressWarnings: true,
    });
});



/// Delete Record
let btn_delete = (element, id) => {
    alertText = 'Eliminar';
    if (id != "" && id != 0) {
        swal({
            title: alertText + " Detalles del Proyecto!",
            text: "Estás seguro que quieres '" + alertText + "' esto Detalles del Proyecto?",
            type: "warning",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            focusConfirm: false,
            confirmButtonText: "Sí, hazlo!",
            preConfirm: function () {
                return new Promise(function (resolve, reject) {
                    resolve(delete_record_project(element, id));
                })
            }
        });
    }
}
let delete_record_project = (element, id) => {
    $.ajax({
        url: win_loc + 'Project/delete_project_record',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'enable_bit': 0,
            'delete_bit': 1
        },
        success: onSuccess_delete_project(element, 1),
        error: function (res) {
            swal("Error Inesperado", "Por favor, póngase en contacto con el administrador del sistema.", "error");
        },
        failure: function (res) {
            swal("Error Inesperado", "Por favor, inténtelo de nuevo más tarde.", "error");
        }
    });
}
let onSuccess_delete_project = (e, deleted) => {
    return function (res) {
        try {
            if (res.status == '200') {
                if (deleted == '1') {
                    $('.dataTables-grd').DataTable().row($(e).closest('tr')).remove().draw();
                }
                swal("Proyecto", "Proyecto eliminado con exito!", "success");
            } else {
                swal("Proyecto ", res.msg, "error");
            }
        } catch (e) {
            swal("Proyecto ", e.message, "error");
        }
    }
}
/// Disable Record
let btn_disable = (element, id) => {
    var alertText = '';
    var enable = $(element).data('id');
    if (enable) { alertText = 'Habilitar'; } else { alertText = 'Deshabilita'; }

    if (id != "" && id != 0) {
        swal({
            title: alertText + " del Proyecto! ",
            text: "Estás seguro que quieres '" + alertText + "' esto Detalles del Proyecto?",
            type: "warning",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            focusConfirm: false,
            confirmButtonText: "Sí, hazlo!",
            preConfirm: function () {
                return new Promise(function (resolve, reject) {
                    resolve(disable_project(element, enable, id, alertText))
                })
            }
        });
    }
}
let disable_project = (element, enable, id, alertText) => {
    $.ajax({
        url: win_loc + 'Project/disable_project',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'enable_bit': parseInt(enable)
        },
        success: onSuccess_disable_project(element, enable, alertText),
        error: function (res) {
            swal("Error Inesperado", "Por favor, póngase en contacto con el administrador del sistema.", "error");
        },
        failure: function (res) {
            swal("Error Inesperado", "Por favor, inténtelo de nuevo más tarde.", "error");
        }
    });
}
let onSuccess_disable_project = (e, enable, alertText) => {
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
                swal("Proyecto", "Proyecto " + alertText + " exitoso !", "success");
            } else {
                swal("Proyecto ", res.msg, "error");
            }
        } catch (e) {
            swal("Proyecto ", e.message, "error");
        }
    }
}
let update_status = (element, id) => {
    var status = $(element).data('status');
    var alertText = (status == 1) ? "Terminado" : "Archivado";
    if (id != "" && id != 0) {
        swal({
            title: "Fonfirmación",
            text: "¿De verdad quieres marcar este proyecto como '" + alertText + "' ?",
            type: "info",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            focusConfirm: false,
            confirmButtonText: "Sí, hazlo!",
            preConfirm: function () {
                return new Promise(function (resolve, reject) {
                    resolve(when_confirmed(element, id, status))
                })
            }
        });
    }
}
let when_confirmed = (element, id, status) => {

    $.ajax({
        url: win_loc + 'Project/update_status',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id': id,
            'status': parseInt(status)
        },
        success: when_completed(element, 1),
        error: function (res) {
            swal("Error Inesperado", "Por favor, póngase en contacto con el administrador del sistema.", "error");
        },
        failure: function (res) {
            swal("Error Inesperado", "Por favor, inténtelo de nuevo más tarde.", "error");
        }
    });
}
let when_completed = (e, completed) => {
    return function (res) {
        try {
            if (res.status == '200') {
                if (completed == '1') {
                    $('.dataTables-grd').DataTable().row($(e).closest('tr')).remove().draw();
                }
                swal("Proyecto", "Proyecto marcado como completado éxito !", "success");
            }
            else {
                swal("Proyecto ", "Ocurrió un error inesperado", "error");
            }
        }
        catch (e) {
            swal("Proyecto ", "Ocurrió un error inesperado", "error");
        }
    }
}

$('.make_project_pdf').on('click',function(){
    
    let merge =  $.ajax({
        url : base_url+'/project/gpcc',
        method : 'POST',
        dataType : 'JSON',
        data : {
            pid : $(this).data('project_id')
        }
    })

    merge.then(res => {
        alert('merge success')
    })
    merge.catch(error => {
        console.warn(error)
    })
});