<style>
    p {
        margin-top: 5px;
        color: #ff5112;
    }
</style>
<div class="d-flex  justify-content-center">
    <div class="card col-lg-8 rounded">
        <div class="card-header mt-4">
            <h2><?= $pageHeading ?></h2>
        </div>
        <div class="card-body">
            <form action="<?= base_url('AddProject') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-row mb-3">
                    <div class="col-md-12">
                        <label for="">Nombre proyecto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" name="project_name" placeholder="Nombre proyecto" value="<?= set_value('project_name') ?>">
                        </div>
                        <?= form_error('project_name') ?>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label for="">Localización del Proyecto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-location-pin"></span>
                            </div>
                            <input type="text" class="form-control" name="location" placeholder="Localización del Proyecto" value="<?= set_value('location') ?>">
                        </div>
                        <?= form_error('location') ?>
                    </div>
                    <div class="col-md-6">
                        <label for="">Tamaño del Proyecto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-size-fullscreen"></span>
                            </div>
                            <input type="number" class="form-control" name="project_size_m2" placeholder="Tamaño del Proyecto" value="<?= set_value('project_size_m2') ?>">
                        </div>
                        <?= form_error('project_size_m2') ?>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label for="">Nombre de Empresa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" name="company_name" placeholder="Nombre de Empresa" value="<?= set_value('company_name') ?>">
                        </div>
                        <?= form_error('company_name') ?>
                    </div>
                    <div class="col-md-6">
                        <label for="">Etiquetas</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-tag-3"></span>
                            </div>
                            <input type="text" class="form-control" name="labels" placeholder="Etiquetas" value="<?= set_value('labels') ?>">
                        </div>
                        <?= form_error('labels') ?>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label for="">Teléfono empresa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-old-telephone"></span>
                            </div>
                            <input type="number" class="form-control" name="phone" placeholder="Teléfono empresa" value="<?= set_value('phone') ?>">
                        </div>
                        <?= form_error('phone') ?>
                    </div>
                    <div class="col-md-6">
                        <label for="">Email de Contacto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-envelope"></span>
                            </div>
                            <input type="email" class="form-control" name="contact_email" placeholder="Email de Contacto" value="<?= set_value('contact_email') ?>">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary add_email"><span class="text-medium simple-icon-plus"></span></button>
                            </div>
                        </div>
                        <?= form_error('contact_email') ?>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-4">
                        <label for="">Propietario</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-user"></span>
                            </div>
                            <input type="text" class="form-control" name="owner" placeholder="Propietario" value="<?= set_value('owner') ?>">
                        </div>
                        <?= form_error('owner') ?>
                    </div>
                    <div class="col-md-4">
                        <label for="">M2 de construccion</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-resize"></span>
                            </div>
                            <input type="number" class="form-control" name="construction_m2" placeholder="M2 de construccion" value="<?= set_value('construction_m2') ?>">
                        </div>
                        <?= form_error('construction_m2') ?>
                    </div>
                    <div class="col-md-4">
                        <label for="">M2 de terreno</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-resize"></span>
                            </div>
                            <input type="number" class="form-control" name="land_m2" placeholder="M2 de terreno" value="<?= set_value('land_m2') ?>">
                        </div>
                        <?= form_error('land_m2') ?>
                    </div>
                </div>
                <div class="form-row additional-emails"></div>
                <div class="form-row mb-3">
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="1" name="underConstruction" checked id="customCheckThis">
                            <label class="custom-control-label" for="customCheckThis">Check if the Project is UnderConstruction</label>
                        </div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-lg-12">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                    <?= form_error('description') ?>
                </div>
                <div class="form-row mb-3">
                    <button class="btn btn-block btn-primary" type="submit">Enviar</button>
                    <a href="<?= base_url('Projects') ?>" class="btn btn-block btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.add_email').on('click', function(e) {
        e.preventDefault();
        $('.additional-emails').append(`
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <input type="email" class="form-control" name="additional_emails[]" placeholder="Email de Contacto" required>
                <div class="input-group-append">
                    <button class="btn btn-sm btn-danger remove_email"><span class="text-medium simple-icon-minus"></span></button>
                </div>
            </div>
        </div>`);
    });

    $(document).on('click', '.remove_email', function() {
        $(this).closest('.col-md-6').remove();
    });
</script>