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
                        <!-- <h3 class="box-title">Data Table With Full Features</h3>-->
                      </div><!-- /.box-header -->
                      <div class="box-body">
                        <div class="row">
                        <div class="col-lg-12 text-right form-group">
                        <a class="btn btn-add pad" onclick="add_district();" href="javascript:void(0);"><i class="iconsminds-add" aria-hidden="true"></i>Add District</a>
                        </div>
                        </div>
                          <div class="table-responsive">
                          <table id="grd" class="table icon_space dataTables-grd">
                              <thead>
                                <tr>
                                  <th>Sr#</th>
                                  <th>Title</th>
                                  <th>Location</th>
                                  <th class="text-center">Lodges</th>
                                  <th class="text-center">Enable</th>
                                  <th class="text-center">Action</th>
                                </tr>
                              </thead>
                              <tbody id="grd">
                                <?php foreach($districts as $district): ?>
                                <tr>
                                  <td><?= $district->id ?></td>
                                  <td><?= $district->title ?></td>
                                  <td><?= $district->location ?></td>
                                  <td class="text-center"><?= $district->total_lodges ?></td>
                                  <td class="text-center">
                                    <?php if($district->enable_bit == 1):?>
                                        <a class="btn" type="button" onclick="btn_disable(this,<?php echo $district->id;?>);" data-id="0" href="javascript:void(0);"><i class="simple-icon-check"></i></a>
                                    <?php else: ?>
                                        <a class="btn" type="button" onclick="btn_disable(this,<?php echo $district->id;?>);" data-id="1" href="javascript:void(0);"><i class="iconsminds-close"></i></a>
                                    <?php endif; ?>
                                  </td>
                                  <td class="text-center">
                                    <a title="Edit" class="btn btn-icon" id="btnEdit" onclick="btn_update_detail(this,<?php echo $district->id;?>);" href="javascript:void(0);" ><i class="simple-icon-note" aria-hidden="true"></i></a>
                                    <?php if($district->delete_bit == 1): ?>
                                      <a title="Retore" class="btn btn-icon" id="btnRestore" onclick="btn_delete(this,<?php echo $district->id;?>);" data-id="0" href="javascript:void(0);" ><i class="simple-icon-action-undo" aria-hidden="true"></i></a>
                                    <?php else:?>
                                      <a title="Delete" class="btn btn-icon" id="btnDelete" onclick="btn_delete(this,<?php echo $district->id;?>);" data-id="1" href="javascript:void(0);" ><i class="simple-icon-trash" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                      <a title="View" class="btn btn-icon" data-id="1" href="<?= base_url('Admin/lodges/'.$district->id);?>" ><i class="simple-icon-eye" aria-hidden="true"></i></a>
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
    <script src="<?php echo base_url(); ?>Assets/js/custum/district_view.js"></script>
  </div>
</div>
    
