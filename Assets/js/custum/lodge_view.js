var win_loc = document.getElementById("callBackLoc").value;
//////////////////////////////////////////////////
///////////     Update record     ///////////////
////////////////////////////////////////////////

function btn_update_detail(e, ID){
    swal({
        title: 'Update Lodge Details',
        html: insert_add_view(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function() {

            var select ='<select id="pageSelect" class="form-control m-b" name="pageSelect">';
            select += '<option value="" selected disabled>Select Page</option>';
            $.ajax({
                url: win_loc+'/get_district_data',
                method: 'GET',
                contentType: "application/json; charset:utf-8",
                dataType: 'json',
                success: function(res){
                    var count = res.count;
                        for (var i=0; i<count; i++ ){
                            $("#pageSelect").append('<option value="'+res.data[i].id+'">'+res.data[i].title+'</option>');
                        }
                }
            });
            select += '</select>';
            $('#paste').html(select);
            $('#pageSelect').focus();
            
            $('#txtID').val(ID);//setting ID here, otherwise would have to pass another parameter to above functions
            var tableObj = $('.dataTables-grd').DataTable();
            var rowObj = $(e).closest('tr');
            $('#lodgeTitle').val(tableObj.row(rowObj).data()[1]);
            $('#lodgeLocation').val(tableObj.row(rowObj).data()[2]);
            $('#isGrant').val(tableObj.row(rowObj).data()[3]);
            $('#pageSelect').val(tableObj.row(rowObj).data()[4]);
        },
        preConfirm: function () {
            return new Promise(function (resolve,reject) {
                if($('#lodgeTitle').val() == "" || $('#lodgeLocation').val() == "" || $('#pageSelect :selected').val() =="" || $('#isGrant :selected').val() == "")
                {reject("Please fill all mendatory(*) fields first!");}
            resolve([
                $('#txtID')                 .val(),
                $('#lodgeTitle')            .val(),
                $('#lodgeLocation')         .val(),
                $('#isGrant :selected')     .val(),
                $('#pageSelect :selected')  .val()
            ])
            })
        }
    })
    .then(function (result) {
        swal.showLoading();
            swal({
            title: "Update Lodge Details",
            text: "Are you sure you want to Update this Lodge detail?",
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
        url: win_loc+'/update_lodge_details',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        data: {
            'id'            :detail[0],
            'title'         :detail[1],
            'location'      :detail[2],
            'is_grant'      :detail[3],
            'district_id'   :detail[4]
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
                swal("Lodge Record", "Updated successfully.", "success");
            }else{
                swal("Lodge", res.msg, "error");
            }
        }catch(e){
            swal("Lodge", e.message(), "berror");
        }
    }
}


//////////////////////////////////////////////////
///////////     Add New Record     //////////////
////////////////////////////////////////////////
function add_lodge(){
    swal({
        title: 'Add New Lodge',
        html: insert_add_view(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function(){

            var select ='<select id="distSelect" class="form-control m-b" name="distSelect">';
            select += '<option value="" selected disabled>Select District</option>';
            $.ajax({
                url: win_loc+'/get_district_data',
                method: 'GET',
                contentType: "application/json; charset:utf-8",
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    var count = res.count;
                        for (var i=0; i<count; i++ ){
                            $("#distSelect").append('<option value="'+res.data[i].id+'">'+res.data[i].title+'</option>');
                        }
                }
            });
            select += '</select>';
            $('#paste').html(select);
            $('#lodgeTitle').focus();
        },
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if($('#lodgeTitle').val() == "" || $('#lodgeLocation').val() == "" || $('#distSelect :selected').val() == "" || $('#isGrant :selected').val() == "")
                {reject("Please fill all mendatory(*) fields first!");}
            resolve([
                $('#lodgeTitle').val(),
                $('#lodgeLocation').val(),
                $('#distSelect :selected').val(),
                $('#isGrant :selected').val()
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
        url: win_loc+'/add_new_lodge',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'title':detail[0], 
            'location':detail[1],
            'district_id':detail[2],
            'is_grant':detail[3]
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
            swal(" Lodge ", "Added Successfully!", "success");
        }else{
            swal("Lodge ", res.msg, "error");
        }
    }catch(e){
        swal("Lodge", e.message, "error");
    }
}
//////////////////////////////////////////////////
///////////     Disable record     //////////////
////////////////////////////////////////////////
function btn_disable(e, ID){
    var alertText = '';
    var enable = $(e).data('id');
    if(enable){alertText = 'Enable';}else{alertText = 'Disable';}

    if (ID != "" && ID != 0){
        swal({
            title: alertText+" this Lodge! ",
            text: "Are you sure you want to '"+ alertText +"' this Lodge ?",
            type: "warning",
            showLoaderOnConfirm: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "Yes, do it!",
            preConfirm: function (value) {
                return new Promise(function (resolve, reject) {
                    resolve(disable_record(e, enable, ID))
                })
            }
        });
    }
}
function disable_record(e, enable, ID){
    $.ajax({
        url: win_loc+'/disable_lodge',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id':ID, 
            'enable_bit':parseInt(enable)
        },
        success: onSuccess_disable_record(e,enable),
        error: function (res){
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
            swal("Lodge", "Updated successfully.", "success");
        }else{
            swal("Lodge", res.msg, "error");
        }
        }catch(e){
            swal("Lodge", e.message, "error");
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
        title: alertText + " Lodge !!!",
        text: "Are you sure you want to '"+ alertText +"' this Lodge record?",
        type: "warning",
        showLoaderOnConfirm: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: "Yes, do it!",
        preConfirm: function (email) {
                return new Promise(function (resolve, reject) {
                    resolve(delete_record_lodge(e, deleted, id))
                })
            }
        });
    }
}
function delete_record_lodge(e, deleted, id){
    $.ajax({
        url: win_loc+'/delete_lodge_details',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'id':id,
            'enable_bit':parseInt(deleted==1?0:1),
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
            swal("Lodge", "Lodge deleted successfully!", "success");
        }else{
            swal("Lodge ", res.msg, "error");
        }
        }catch(e){
            swal("Lodge ", e.message, "error");
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
                //   '<div class="row">'+
                //         '<div class="col-sm-2">'+
                //             '<label class="my-2"> District </label>'+
                //         '</div>'+
                //         '<div class="col-sm-10" id="paste" >'+
                //         '</div>'+
                //     '</div>'+
                    '<br>'+
                    '<div class="row">'+
                        '<div class="col-sm-2">'+
                            '<label class="my-2"> Title </label>'+
                        '</div>'+
                        '<div class="col-sm-10">'+
                            '<input type ="text" id="lodgeTitle" class="form-control" placeholder="Enter Lodge Title here !!!">'+
                        '</div>'+
                    '</div>'+
                    '<br>'+
                    '<div class="row">'+
                        '<div class="col-sm-2">'+
                            '<label class="my-2" > Location </label>'+
                        '</div>'+
                        '<div class="col-sm-10">'+
                            '<input type ="text" id="lodgeLocation" class="form-control" placeholder="Enter Lodge location here !!!">'+
                        '</div>'+
                    '</div>'+
                    '<br>'+
                    '<div class="row">'+
                        '<div class="col-sm-2">'+
                            '<label class="my-2"> District </label>'+
                        '</div>'+
                        '<div class="col-sm-10" id="paste" >'+
                        '</div>'+
                    '</div>'+
                    '<br>'+
                    '<div class="row">'+
                        '<div class="col-sm-2">'+
                            '<label class="my-2" > IsGrand </label>'+
                        '</div>'+
                        '<div class="col-sm-10">'+
                            '<select id="isGrant" class="form-control">'+
                                '<option value="" selected disabled>Select Option</option>'+
                                '<option value=1>Yes</option>'+
                                '<option value=0>No</option>'+
                            '</select>'+
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
    var isGrand = '';
    
    if(row.enable_bit){status = ' simple-icon-check '; button_dan_pri = ' btn-primary ';}
    else{status = ' iconsminds-close ';button_dan_pri = ' btn-danger ';}


    // <td class="text-center"><?php if ($lodge->is_grant == 1) {echo '<input class="my-3" type="radio" checked>';} ?></input>

    if(row.is_grant == 1){isGrand = '<input class="my-3" type="radio" checked>'}
    $('.dataTables-grd').DataTable().row.add([
        row.id,
        row.title,
        row.location,
        isGrand,
        row.district_id,
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
