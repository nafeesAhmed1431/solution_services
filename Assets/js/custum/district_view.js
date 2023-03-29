var win_loc = document.getElementById("callBackLoc").value;
//////////////////////////////////////////////////
///////////     Update record     ///////////////
////////////////////////////////////////////////

function btn_update_detail(e, id){
    swal({
        title: 'Update District Details',
        html: insert_add_view(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function() {
            $('#txtID').val(id);//setting ID here, otherwise would have to pass another parameter to above functions
            var tableObj = $('.dataTables-grd').DataTable();
            var rowObj = $(e).closest('tr');
            $('#districtTitle').val(tableObj.row(rowObj).data()[1]);
            $('#districtLocation').val(tableObj.row(rowObj).data()[2]);
        },
        preConfirm: function () {
            return new Promise(function (resolve,reject) {
                if($('#districtTitle').val() == "" || $('#districtLocation').val() == "")
                {reject("Please fill all mendatory(*) fields first!");}
            resolve([
                $('#txtID')             .val(),
                $('#districtTitle')     .val(),
                $('#districtLocation')  .val()
            ])
            })
        }
    })
    .then(function (result) {
        swal.showLoading();
            swal({
            title: "Update District Record",
            text: "Are you sure you want to Update this District detail?",
            icon: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            button: {
                text: "Yes!",
                value:true,
                visible:true,
                closeModal: false
            },defeat:true
            })
            .then((value) => {
                if(value)
                    update_detail(e, result);
            });
    })
    .catch(swal.noop);
}
function update_detail(e, detail){
    $.ajax({
        url: win_loc+'/update_district_details',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        data: {
            'id'            :detail[0],
            'title'         :detail[1],
            'location'      :detail[2]
        },
        success: onSuccess_update_detail(e),
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_update_detail(e){
    return function(res){
        try{
            res = JSON.parse(res);
            if(res.status == 200){
                $('.dataTables-grd').DataTable().row($(e).closest('tr')).remove().draw();
                add_new_row_dataTable(e, res);
                swal("District Record", "Updated successfully.", "success");
            }else{
                swal("District", res.msg, "error");
            }
        }catch(e){
            swal("District", e.message(), "berror");
        }
    }
}

//////////////////////////////////////////////////
///////////     Add New Record     //////////////
////////////////////////////////////////////////
function add_district(){
    swal({
        title: 'Add New District',
        html: insert_add_view(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function() {
            $('#pageTitle').focus();
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if($('#districtTitle').val() == "" || $('#districtLocation').val() == "")
                {reject("Please fill all mendatory(*) fields first!");}
            resolve([
                $('#districtTitle').val(),
                $('#districtLocation').val()
            ])
            })
        }
    }).then(function (result) {
        swal.showLoading();
        add_record(JSON.parse(JSON.stringify(result)));
    }).catch(swal.noop);

}
function add_record(detail){
    $.ajax({
        url: win_loc+'/add_new_district',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'title':detail[0],
             'location':detail[1]
            },
        success: onSuccess_add_record,
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_add_record(res){
    try{
        if(res.status == 200){
            add_new_row_dataTable(null, res);
            swal(" District ", "Data Added Successfully!", "success");
        }else{
            swal("District ", res.msg, "error");
        }
    }catch(e){
        swal("District", e.message, "error");
    }
}
//////////////////////////////////////////////////
///////////     Disable record     //////////////
////////////////////////////////////////////////
function btn_disable(e, id){
    var alertText = '';
    var enable = $(e).data('id');
    if(enable){alertText = 'Enable';}else{alertText = 'Disable';}

    if (id != "" && id != 0){
        swal({
            title: alertText+" District!",
            text: "Are you sure you want to '"+ alertText +"' this District ?",
            type: "warning",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "Yes, do it!",
            preConfirm: function(value){
                return new Promise(function (resolve, reject) {
                    resolve(disable_record(e, enable, id))
                })
            }
        });
    }
}
function disable_record(e, enable, id){
    $.ajax({
        url: win_loc+'/disable_district',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id':id, 
            'enable_bit':parseInt(enable)
        },
        success: onSuccess_disable_record(e,enable),
        error: function (res) {
            console.log(res);
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_disable_record(e, enable){
    return function(res){
        try{
        if(res.status == 200){
            if(enable == '1'){
                $(e).data('id','0');
                $(e).removeClass('btn-danger').addClass('btn-primary').find('i').removeClass('iconsminds-close').addClass('simple-icon-check');
            }else{
                $(e).data('id','1');
                $(e).removeClass('btn-primary').addClass('btn-danger').find('i').removeClass('simple-icon-check').addClass('iconsminds-close');
            }
            swal("District Details", "Updated successfully.", "success");
        }else{
            swal("District", res.msg, "error");
        }
        }catch(e){
            swal("District", e.message, "error");
        }
    }
}
//////////////////////////////////////////////////
///////////     Delete record     ///////////////
////////////////////////////////////////////////
function btn_delete(e, id){
    var alertText = '';
    var deleted = $(e).data('id');
    alertText = 'Delete';
    if (id != "" && id != 0){
        swal({
        title: alertText + " District Record!",
        text: "Are you sure you want to '"+ alertText +"' this District record?",
        type: "warning",
        showLoaderOnConfirm: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: "Yes, do it!",
        preConfirm: function (email) {
                return new Promise(function(resolve, reject){
                        resolve(delete_record_district(e, deleted, id));
                })
            }
        });
    }
}
function delete_record_district(e,deleted, id){
    // alert(deleted);
    //         alert(id);
    //         throw new Error("Execution Stopped");
    $.ajax({
        url: win_loc+'/delete_district_record',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id':id,
            'enable_bit':0,
            'delete_bit':deleted
        },
        success: onSuccess_delete_record(e, deleted),
        error: function (res) {
            swal("Upexpected Error", "Please contact system administrator.", "error");
        },
        failure: function (res) {
            swal("Upexpected Error", "Please try again later.", "error");
        }
    });
}
function onSuccess_delete_record(e, deleted){
    return function(res){
        try{
        if(res.status == '200'){
            if(deleted == '1'){
                $(e).data('id','0');
                $('.dataTables-grd').DataTable().row($(e).closest('tr')).remove().draw();
            }else{
                $(e).data('id','1');
            }
            swal("District", "District deleted successfully!", "success");
        }else{
            swal("District ", res.msg, "error");
        }
        }catch(e){
            swal("District ", e.message, "error");
        }
    }
}

/////////////////////////////////////////////////
///////////     Helping Methods     ////////////
///////////////////////////////////////////////
function insert_add_view(){
    var strView = '<hr class="hr-success" />'+
    '<div class="row">'+
            '<div class="col-sm-12 form-horizontal">'+
                '<div class="form-group">'+
                    '<div class="row">'+
                        '<div class="col-sm-2">'+
                            '<label class="my-2"> Title </label>'+
                        '</div>'+
                        '<div class="col-sm-10">'+
                            '<input type ="text" id="districtTitle" class="form-control" placeholder="Enter District Title here !!!">'+
                        '</div>'+
                    '</div>'+
                    '<br>'+
                    '<div class="row">'+
                        '<div class="col-sm-2">'+
                            '<label class="my-2" > Location </label>'+
                        '</div>'+
                        '<div class="col-sm-10">'+
                            '<input type ="text" id="districtLocation" class="form-control" placeholder="Enter District location here !!!">'+
                        '</div>'+
                    '</div>'+
                    '<input type="hidden" id="txtID" />'+
                '</div>'+
            '</div>'+
        '</div>';
        return strView;
}
function add_new_row_dataTable(e, res){
    var row = res.result[0];
    var typ = 0;
    var status = '';
    var button_dan_pri = '';
    if(row.enable_bit)
    {
        status = ' simple-icon-check '; button_dan_pri = ' btn-primary ';
    }
    else
    {
        status = ' iconsminds-close ';button_dan_pri = ' btn-danger ';
    }

    $('.dataTables-grd').DataTable().row.add([
        row.id,
        row.title,
        row.location,
        'Number of Lodges',
        '<button class="btn '+ button_dan_pri +' btn-circle" type="button" onclick="btn_disable(this,'+ row.id +');" data-id="'+ (row.enable = 1 ? 0 : 1) +'" href="javascript:void(0);"><i class="'+ status +'"></i>'+
            '</button>',
        '<a title="Edit" class="btn btn-success btn-icon" id="btnEdit" onclick="btn_update_detail(this,'+ row.id +');" href="javascript:void(0);">'+
            '<i class="simple-icon-note" aria-hidden="true"></i>'+
            '</a>'+
            ' <a title="Delete" class="btn btn-danger btn-icon" onclick="btn_delete(this,'+ row.id +');" data-id="1" href="javascript:void(0);" >'+
            '<i class="simple-icon-trash" aria-hidden="true"></i></a>'
    ]).draw();
}

function permission_disabled(msg)
{
    swal(msg, 'You donot have permission to '+msg,'error');
}