<div class="d-flex  justify-content-center">
    <div class="card col-lg-8 round_corner mb-5">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h2><?= $pageHeading . " : '" . $project[0]->project_name . "'" ?></h2>
                <a class="badge badge-info" href="<?php echo base_url('Project/edit_project_checklists/') . $project[0]->id; ?>"><i class="simple-icon-note"></i> Edit Checklists</a>
            </div>
            <hr>
            <form class=" mb-5" action="<?= base_url('UpdateProject') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="">Nombre Proyecto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input name="id" value="<?= $project[0]->id ?>" hidden>
                            <input type="text" class="form-control" name="project_name" placeholder="Nombre proyecto" value="<?= (empty($project)) ? set_value('project_name') : $project[0]->project_name; ?>">
                        </div>
                        <p class="text-danger"><?= form_error('project_name') ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Localización del Proyecto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-location-pin"></span>
                            </div>
                            <input type="text" class="form-control" name="location" placeholder="Localización del Proyecto" value="<?= (empty($project)) ? set_value('location') : $project[0]->location; ?>">
                        </div>
                        <p class="text-danger"><?= form_error('location') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Tamaño del Proyecto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-size-fullscreen"></span>
                            </div>
                            <input type="number" class="form-control" name="project_size_m2" placeholder="Tamaño del Proyecto" value="<?= (empty($project)) ? set_value('project_size_m2') : $project[0]->project_size_m2; ?>">
                        </div>
                        <p class="text-danger"><?= form_error('project_size_m2') ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Nombre de Empresa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" name="company_name" placeholder="Nombre de Empresa" value="<?= (empty($project)) ? set_value('company_name') : $project[0]->company_name; ?>">
                        </div>
                        <p class="text-danger"><?= form_error('company_name') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Etiquetas</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-tag-3"></span>
                            </div>
                            <input type="text" class="form-control" name="labels" placeholder="Etiquetas" value="<?= (empty($project)) ? set_value('labels') : $project[0]->labels; ?>">
                        </div>
                        <p class="text-danger"><?= form_error('labels') ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Teléfono empresa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-old-telephone"></span>
                            </div>
                            <input type="number" class="form-control" name="phone" placeholder="Teléfono empresa" value="<?= (empty($project)) ? set_value('phone') : $project[0]->phone; ?>">
                        </div>
                        <p class="text-danger"><?= form_error('phone') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email de Contacto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-envelope"></span>
                            </div>
                            <input type="email" class="form-control" name="contact_email" placeholder="Email de Contacto" value="<?= (empty($project)) ? set_value('contact_email') : $project[0]->contact_email; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary add_email"><span class="text-medium simple-icon-plus"></span></button>
                            </div>
                        </div>
                        <p class="text-danger"><?= form_error('contact_email') ?></p>
                    </div>
                </div>
                <div class="form-row additional-emails">
                    <?php if (!empty($additional_emails)) :  foreach ($additional_emails as $email) : ?>
                            <div class="col-md-6 mb-3 additional_email">
                                <div class="input-group">
                                    <input type="email" class="form-control" name="additional_emails[]" placeholder="Email de Contacto" required value="<?= $email ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-danger remove_email"><span class="text-medium simple-icon-minus"></span></button>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach;
                    endif; ?>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="1" name="underConstruction" <?= empty($project) ? ((empty(set_value('underConstruction') == 1) ? 'checked' : '')) : (($project[0]->const_bit == 1) ? 'checked' : '') ?> id="customCheckThis">
                            <label class="custom-control-label" for="customCheckThis">Check this if the Project is UnderConstruction</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-12">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="3"><?= (empty($project)) ? set_value('description') : $project[0]->description; ?></textarea>
                    </div>
                    <p class="text-danger"><?= form_error('labels') ?></p>
                </div>
                <br>
                <button class="btn btn-block btn-primary" type="submit">Actualizar</button>
                <a href="<?= base_url('Projects') ?>" class="btn btn-block btn-danger">Cancelar</a>
            </form>

        </div>
    </div>
</div>
<script src="<?= base_url('Assets/js/plugins/sweetalert2.js') ?>"></script>
<script>

    let email_count = "<?=$additional_emails_count?>";

    $('.add_email').on('click', function(e) {
        e.preventDefault();
        if(email_count <= 4){
            $('.additional-emails').append(`
            <div class="col-md-6 mb-3 additional_email">
                <div class="input-group">
                    <input type="email" class="form-control" name="additional_emails[]" placeholder="Email de Contacto" required>
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-danger remove_email"><span class="text-medium simple-icon-minus"></span></button>
                    </div>
                </div>
            </div>`);
            email_count++;
        }else{
            Swal.fire({
                title : 'Warning',
                text : 'You cannot Add more than 5 additional Emails',
                toast : true,
                timer : 2000,
                position : 'top-end',
                showConfirmButton : false,
                showConfirmButton : false,
                icon : 'warning'
            });
        }
    });

    $(document).on('click', '.remove_email', function() {
        $(this).closest('.additional_email').remove();
        email_count--;
    });
</script>