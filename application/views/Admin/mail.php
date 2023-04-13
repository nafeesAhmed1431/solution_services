<style>
    .text-dark {
        color: #bdc0c4 !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1><?= $pageHeading ?></h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('Dashboard') ?>">Dashboard</a>
                    </li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row mails"></div>
</div>

<script>
    $(document).ready(function() {
        load_cards();
    });

    function load_cards() {
        $('.mails').empty();
        $.ajax({
            url: "<?= base_url('Admin/get_mail_settings') ?>",
            method: 'POST',
            dataType: 'JSON',
            success: res => {
                if (res.data) {
                    for (item of res.data) {
                        $('.mails').append(mail_card(item));
                    }
                }
            }
        });
    }

    function mail_card(data) {
        let card = `
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header mt-3">
                    <h1 class="text-dark">${data.setting_name}.</h1>
                </div>
                <div class="card-body">
                    <form class="mail_update" action="javascript:void(0)">
                        <input type="hidden" name="id" value="${data.id}">
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input type="email" class="form-control" name="email" value="${data.smtp_user}" autocomplete="off" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" name="password" value="${data.smtp_password}" autocomplete="off" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block default">Update</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-8">
                            ${data.active == 0 ? "<a class='btn btn-success default activate' href='javascript:void(0)' data-id='" + data.id + "' class='btn btn-default'>Activate</a>" : "" }
                        </div>
                        <div class="col-4 text-right lead">
                            <span class="text-${data.active == 1 ? "success" : "danger"}">
                                <i class="simple-icon-${data.active == 1 ? "check" : "close"}"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        return card;
    }

    $(document).on('click', '.activate', function() {
        $.ajax({
            url: "<?= base_url('Admin/activate_mail') ?>",
            method: 'POST',
            dataType: 'JSON',
            data: {
                id: $(this).data('id')
            },
            success: load_cards()
        });
    });

    $(document).on('submit','.mail_update',function(){
        let data = $(this).serialize();
        $.ajax({
            url : "<?=base_url('Admin/update_email')?>",
            method : 'POST',
            dataType : 'JSON',
            data : data,
            success : load_cards
        });
    });
</script>