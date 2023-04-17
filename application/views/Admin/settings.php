<style>
    .text-dark {
        color: #bdc0c4 !important;
    }

    .modal-dialog {
        max-width: 850px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1><?= $pageHeading ?></h1>
            <div class="d-flex justify-content-between">
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('Dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                        </li>
                    </ol>
                </nav>
                <button type="button" class="btn btn-primary mb-3 default" data-toggle="modal" data-target="#gmail-instructions-modal">
                    SMTP instructions
                </button>
            </div>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="accordion">
                <div class="border">
                    <button class="btn btn-block btn-outline-dafault default" data-toggle="collapse" data-target="#mail">
                        <span class="h4">Mail Settings</span>
                    </button>
                    <div id="mail" class="collapse show" data-parent="#accordion">
                        <div class="p-4 row mails"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Instruction Modal -->
<div class="modal fade" id="gmail-instructions-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gmail-instructions-modal-label">Instructions: Using Gmail SMTP server in your web app</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>1. Go to <a href="https://www.google.com/">https://www.google.com/</a> and sign in to your Google account.</p>
                <p>2. Go to Security settings by clicking on your profile picture in the top-right corner of the screen and selecting "Google Account".</p>
                <p>3. Click on the "Security" tab on the left-hand side of the screen.</p>
                <p>4. Scroll down to "Less secure app access" and turn it on. This will allow your web app to access your Gmail account.</p>
                <p>5. Go back to the "Security" tab and click on "App passwords" under the "Signing in to Google" section.</p>
                <p>6. Select "Custom" from the dropdown menu and enter "SMTP" as the app name.</p>
                <p>7. Click on "Generate" and copy the password that appears.</p>
                <p>8. In your web app, use your Gmail address as the SMTP username and the password you just generated as the SMTP password.</p>
                <p>9. Enter <code class="text-medium"> smtp.google.com </code> as SMTP host.</p>
                <p>10. Use SSL or TSL as Protocol.</p>
                <p>11. Use Port 465 for SSL and 587 for TSL as port.</p>
                <p>12. Hit Update to finally save you settings and start using you google ID for sending Emails.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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

    $(document).on('submit', '.mail_update', function() {
        let data = $(this).serialize();
        $.ajax({
            url: "<?= base_url('Admin/update_email') ?>",
            method: 'POST',
            dataType: 'JSON',
            data: data,
            // success: load_cards()
            success: res => {
                if (res.res) {
                    location.reload();
                }
            }
        });
    });

    function mail_cards(data) {
        let card = `
        <div class="col-lg-3">
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

    function mail_card(data) {
        let card = `<div class="col-lg-4">
                        <div class="card">
                            <div class="card-header mt-3">
                                <h1 class="text-dark">${data.setting_name}.</h1>
                            </div>
                            <div class="card-body">
                                <form class="mail_update" action="javascript:void(0)">
                                    <input type="hidden" name="id" value="${data.id}">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail">Email address</label>
                                            <input type="email" class="form-control" name="email" value="${data.smtp_user}" autocomplete="off" placeholder="${data.smtp_user}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword">Password</label>
                                            <input type="password" class="form-control" name="password" value="${data.smtp_password}" autocomplete="off" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputSmtpHost">SMTP Host</label>
                                            <input type="text" class="form-control" name="smtp_host" value="${data.smtp_host}" autocomplete="off" placeholder="SMTP Host">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputProtocol">Protocol</label>
                                            <select class="form-control" name="protocol">
                                                <option value="ssl" ${data.smtp_crypto==="ssl" ? "selected" : "" }>SSL</option>
                                                <option value="tls" ${data.smtp_crypto==="tls" ? "selected" : "" }>TLS</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputSmtpPort">SMTP Port</label>
                                            <input type="number" class="form-control" name="smtp_port" value="${data.smtp_port}" autocomplete="off" placeholder="SMTP Port">
                                            <small id="emailHelp" class="form-text text-muted">Port 465 for SSL & 587 for TSL.</small>
                                        </div>
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
</script>