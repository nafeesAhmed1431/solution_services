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
                  <a class="btn btn-add pad" href="<?= base_url('AddProject') ?>"><i class="iconsminds-add" aria-hidden="true"></i>Añadir proyecto</a>
                </div>
              </div>
              <div class="table-responsive">
                <table id="allProjectsTable" class="table icon_space dataTables-grd">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Estado</th>
                      <th class="text-center">Bajo Construcción</th>
                      <th class="text-center">Progreso</th>
                      <th class="text-center">Habilitar</th>
                      <th class="text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($projects as $project) : ?>
                      <?php $curr = ($this->Project_model->current_progress($project->id)[0]->current); $max = ($this->Project_model->max_progress($project->id)[0]->max); ?>
                      <tr>
                        <td><?= $project->id ?></td>
                        <td><?= $project->project_name ?></td>
                        <td>
                          <?php if(($max-$curr) != 0): ?>
                            <?php if ($project->status == 2) : ?>
                              <p class="badge badge-danger"><?= $max-$curr ?> Archivos pendientes</p>
                            <?php elseif ($project->status == 3) : ?>
                              <p class="badge badge-info">Archivado</p>
                            <?php else : ?>
                              <p class="badge badge-success">Terminado</p>
                            <?php endif; ?>
                          <?php else: ?>
                            <p class="badge badge-success">Terminado</p>
                          <?php endif; ?>
                        </td>
                        <td class="text-center"><span class=" text-large <?= $project->const_bit == 1 ?'iconsminds-shopping-cart':''?>"></span></td>
                        <td class="text-center">
                          <div class=" bg-light ">
                            <?php if(empty($curr || $max)) {?>
                              <?php print_r('No File Uploaded');?>
                            <?php }else{?>
                              <?php if((($curr/$max)*100) > 0): ?>
                                <div title="<?=intval((($curr/$max)*100))."%"?>" class="progress-bar bg-<?php if ((($curr/$max)*100) < 50) {echo "danger";} elseif ((($curr/$max)*100) < 80) {echo "warning";} else {echo "success";} ?> badge " style="width:<?= (($curr/$max)*100) ?>%"><?= intval((($curr/$max)*100)) ?>%</div>
                              <?php else: ?>
                                <h6 class="text-muted round_corner p-1 text-small">No hay documentos Subidos</h6>
                              <?php endif; ?>
                            <?php }?>
                          </div>
                        </td>
                        <td class="text-center">
                          <?php if ($project->enable_bit == 1) : ?>
                            <a class="btn" type="button" onclick="btn_disable(this,<?php echo $project->id; ?>);" data-id="0" href="javascript:void(0);"><i class="simple-icon-check"></i></a>
                          <?php else : ?>
                            <a class="btn" type="button" onclick="btn_disable(this,<?php echo $project->id; ?>);" data-id="1" href="javascript:void(0);"><i class="iconsminds-close"></i></a>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <a title="Editar" class="btn btn-icon" id="btnEdit" href="<?= base_url('EditProject/') . $project->id; ?>"><i class="simple-icon-note" aria-hidden="true"></i></a>
                          <a title="Eliminar" class="btn btn-icon" id="btnDelete" onclick="btn_delete(this,<?= $project->id; ?>);" href="javascript:void(0);"><i class="simple-icon-trash" aria-hidden="true"></i></a>
                          <a title="Vista" class="btn btn-icon" href="<?= base_url('ProjectDetails/') . $project->id; ?>"><i class="simple-icon-eye" aria-hidden="true"></i></a>
                          <?php if(empty($curr || $max)) {?>
                            <?php print_r('');?>
                          <?php }else{?>
                            <?php if(($curr/$max)*100 == 100): ?>
                              <a title="Marcar como completado" class="btn btn-icon" href="javascript:void(0)" onclick="update_status(this,<?= $project->id; ?>)" data-status="1"><i class="iconsminds-check" aria-hidden="true"></i></a>
                            <?php endif; ?>
                          <?php }?>
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
<script src="<?= base_url('Assets/js/custum/all_projects_view.js'); ?>"></script>