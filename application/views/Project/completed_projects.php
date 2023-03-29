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
              <div class="table-responsive mt-3">
                <table id="grd" class="table icon_space dataTables-grd">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Estado</th>
                      <th class="text-center">Progreso</th>
                      <th class="text-center">Habilitar</th>
                      <th class="text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody id="grd">
                    <?php foreach ($projects as $project) : ?>
                      <?php $curr = count($this->Project_model->current_progress($project->id));
                      $max = count($this->Project_model->max_progress($project->project_size_m2)); ?>
                      <tr>
                        <td><?= $project->id ?></td>
                        <td><?= $project->project_name ?></td>
                        <td>
                          <?php if (($max - $curr) != 0) : ?>
                            <?php if ($project->status == 2) : ?>
                              <p class="badge badge-danger"><?= $max - $curr ?> files Pending</p>
                            <?php elseif ($project->status == 3) : ?>
                              <p class="badge badge-info">Archivado</p>
                            <?php else : ?>
                              <p class="badge badge-success">Terminado</p>
                            <?php endif; ?>
                          <?php else : ?>
                            <p class="badge badge-success">Terminado</p>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <div class=" bg-light ">

                            <?php if ((($curr / $max) * 100) > 0) : ?>
                              <div title="<?=intval((($curr/$max)*100))."%"?>" class="progress-bar bg-<?php if ((($curr / $max) * 100) < 50) {
                                                            echo "danger";
                                                          } elseif ((($curr / $max) * 100) < 80) {
                                                            echo "warning";
                                                          } else {
                                                            echo "success";
                                                          } ?> badge " style="width:<?= (($curr / $max) * 100) ?>%"><?= intval((($curr / $max) * 100)) ?>%</div>
                            <?php else : ?>
                              <h6 class="text-muted round_corner p-1 text-small">No hay documentos Subidos</h6>
                            <?php endif; ?>
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
                          <a title="Marcar como archivado" class="btn btn-icon" href="javascript:void(0)" onclick="update_status(this,<?= $project->id; ?>)" data-status="3"><i class="iconsminds-download-1" aria-hidden="true"></i></a>
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