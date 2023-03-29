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
                                  <th>Sr#</th>
                                  <th>Name</th>
                                  <th>Status</th>
                                  <th class="text-center">Progress</th>
                                  <th class="text-center">Enable</th>
                                  <th class="text-center">Action</th>
                                </tr>
                              </thead>
                              <tbody id="grd">
                                <?php foreach($projects as $project): ?>
                                <tr>
                                  <td><?= $project->id ?></td>
                                  <td><?= $project->project_name ?></td>
                                  <td>
                                    <?php if($project->status == 2): ?>
                                      <p class="badge badge-danger">Pending</p>
                                    <?php elseif($project->status == 3): ?>
                                      <p class="badge badge-info">Archived</p>
                                    <?php else: ?>
                                      <p class="badge badge-success">Completed</p>
                                    <?php endif; ?>
                                  </td>
                                  <td class="text-center">
                                    <div class=" bg-light ">
                                      <div class="progress-bar bg-<?php if($progress<50){echo"danger";}elseif($progress<80){echo"warning";}else{echo"success";} ?> badge " style="width:<?= $progress?>%"><?= $progress?>%</div>
                                    </div>
                                  </td>
                                  <td class="text-center">
                                    <?php if($project->enable_bit == 1):?>
                                        <a class="btn" type="button" onclick="btn_disable(this,<?php echo $project->id;?>);" data-id="0" href="javascript:void(0);"><i class="simple-icon-check"></i></a>
                                    <?php else: ?>
                                        <a class="btn" type="button" onclick="btn_disable(this,<?php echo $project->id;?>);" data-id="1" href="javascript:void(0);"><i class="iconsminds-close"></i></a>
                                    <?php endif; ?>
                                  </td>
                                  <td class="text-center">
                                    <a title="Edit" class="btn btn-icon" id="btnEdit" onclick="btn_update_detail(this,<?php echo $project->id;?>);" href="javascript:void(0);" ><i class="simple-icon-note" aria-hidden="true"></i></a>
                                    <?php if($project->delete_bit == 1): ?>
                                      <a title="Retore" class="btn btn-icon" id="btnRestore" onclick="btn_delete(this,<?php echo $project->id;?>);" data-id="0" href="javascript:void(0);" ><i class="simple-icon-action-undo" aria-hidden="true"></i></a>
                                    <?php else:?>
                                      <a title="Delete" class="btn btn-icon" id="btnDelete" onclick="btn_delete(this,<?php echo $project->id;?>);" data-id="1" href="javascript:void(0);" ><i class="simple-icon-trash" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                      <a title="View" class="btn btn-icon" data-id="1" href="<?= base_url('Admin/lodges/'.$project->id);?>" ><i class="simple-icon-eye" aria-hidden="true"></i></a>
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
    <input type="hidden" id="callBackLoc" value="<?php echo base_url('admin');?>"/>
    <script src="<?php echo base_url(); ?>Assets/js/custum/project_view.js"></script>
  </div>
</div>
    
