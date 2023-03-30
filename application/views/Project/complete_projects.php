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
            <div class="box-header">
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12 text-right form-group">
                  <a class="btn btn-light pad" href="<?= base_url($back) ?>"><i class="iconsminds-back" aria-hidden="true"></i> Go Back</a>
                </div>
              </div>
              <div class="table-responsive">
                <table id="grd" class="table icon_space dataTables-grd">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Owner</th>
                      <th>Nombre</th>
                      <th>Estado</th>
                      <th>Location</th>
                      <th class="text-center">Bajo Construcción</th>
                      <th class="text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody id="grd">
                    <?php foreach ($projects as $project) : ?>
                      <tr>
                        <td><?= $project->project_id ?></td>
                        <td>
                          <?= $project->full_name ?>
                          <br>
                          <span class="text-small text-muted">
                            <?= $project->user_email ?>
                          </span>
                        </td>
                        <td>
                          <?= $project->project_name ?>
                          <br>
                          <span class="text-small text-muted"><?= $project->company_name ?></span>
                        </td>
                        <td>
                          <span class="badge badge-<?= ($project->project_status == 1) ? 'success' : (($project->project_status == 2) ? 'danger' : 'warning'); ?>">
                            <?= ($project->project_status == 1) ? 'Completed' : (($project->project_status == 2) ? 'Pending' : 'Archived'); ?>
                          </span>
                        </td>
                        <td><?= $project->location ?></td>
                        <td class="text-center">
                          <?php if ($project->const_bit) : ?>
                            <span class="text-large iconsminds-refinery"></span>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <a class="btn" href="<?=base_url('ProjectDetails/').$project->project_id?>">
                            <i class="simple-icon-eye"></i>
                          </a>
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