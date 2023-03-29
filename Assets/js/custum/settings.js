let change_text = () => {
    swal({
        title: 'Update Lodge Details',
        html: insert_update(),
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: "Save it!",
        showLoaderOnConfirm: true,
        onOpen: function() {
            $.ajax({
                url: base_url+'Admin/get_card_text',
                method: 'GET',
                contentType: "application/json; charset:utf-8",
                dataType: 'json',
                success: function(res){
                    $('#card_text').val(res.res[0].text);
                }
            });
        },
        preConfirm: function () {
            return new Promise(function (resolve,reject) {
                if($('#card_text').val() == "")
                {reject("Please fill all mendatory(*) fields first!");}
            resolve([
                $('#card_text').val()
            ])
            })
        }
    })
    .then(function (result) {
        swal.showLoading();
            swal({
            title: "Update Text",
            text: "Are you sure you want to Update this Lodge detail?",
            icon: "info",
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
                    hain(result);
            });
    })
    .catch(swal.noop);
}
let hain = res => {
    alert(res);
}

let insert_update = data => {
    var string = `
        <form class="d-flex justify-content-center">
            <div class="form-row text-center">
                <div class="col-lg-4">
                    <label class="form-label">Card Text</label>
                </div>
                <div class="col-lg-12">
                    <textarea col="10" rows="5" class = "form-control" id="card_text" value="" required ></textarea>
                </div>
            </div>
        </form>
    `;
    return string;
}