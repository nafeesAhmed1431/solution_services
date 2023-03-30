<?php if (!empty($this->session->flashdata('msg'))) : ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong><?= $this->session->userdata('user_name'); ?></strong> <?= $this->session->flashdata('msg'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>
<div class="container-fluid disable-text-selection">
  <div class="col-12 list" data-check-all="checkAll">
    <section class="content-header">
      <h1>
        <?php echo $pageHeading; ?>
      </h1>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12 rem">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12 text-right form-group">
                  <a class="btn btn-add pad add_process" href="javascript:void(0);"><i class="iconsminds-add" aria-hidden="true"></i>Add Process</a>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table icon_space dataTables-grd process_table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($processes as $process) : ?>
                      <tr>
                        <td><?= $process->id ?></td>
                        <td><?= $process->title ?></td>
                        <td>
                          <a class="btn process_status" data-status="<?= $process->enable_bit ?>" data-process_id="<?= $process->id ?>" type="button" href="javascript:void(0);">
                            <i class="<?= $process->enable_bit == 1 ? "simple-icon-check" : "iconsminds-close"; ?>"></i>
                          </a>
                        </td>
                        <td class="text-center">
                          <a title="Editar" class="btn btn-icon edit_process" data-process_id="<?=$process->id?>" href="javascript:void(0);"><i class="simple-icon-note" aria-hidden="true"></i></a>
                          <a title="Eliminar" class="btn btn-icon delete_process" data-process_id="<?=$process->id?>" href="javascript:void(0);"><i class="simple-icon-trash" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div><!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <input type="hidden" id="callBackLoc" value="<?php echo base_url(); ?>" />
  </div>
</div>
<input type="hidden" id="baseUrl" value="<?= base_url() ?>" />
<script src="<?= base_url('Assets/js/custum/process_view.js') ?>"></script>
<script src="<?= base_url('Assets/js/plugins/sweetalert2.js') ?>"></script>