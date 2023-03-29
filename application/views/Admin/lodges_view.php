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
                  <?php if(empty($pageCheck)): ?>
                    <a class="btn btn-add pad" onclick="add_lodge();" href="javascript:void(0);"><i class="iconsminds-add" aria-hidden="true"></i>Add Lodge</a>
                  <?php else: ?>
                    <a class="btn pad" href="<?= base_url('Districts')?>"><i class="iconsminds-back" aria-hidden="true"></i>Go Back</a>
                  <?php endif; ?>

                </div>
              </div>
              <div class="table-responsive">
                <table id="grd" class="table icon_space  dataTables-grd">
                  <thead>
                    <tr>
                      <th class="text-center">Sr#</th>
                      <th>Title</th>
                      <th>Location</th>
                      <th class="text-center col-lg-1">Is Grand</th>
                      <th class="text-center" >District</th>
                      <th class="text-center">Enable</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody id="grd">
                    <?php foreach ($lodges as $lodge) : ?>
                      <tr>
                        <td  class="py-4 text-center col-lg-1"><?= $lodge->id ?></td>
                        <td class="py-4"><?= $lodge->title ?></td>
                        <td class="py-4"><?= $lodge->location ?></td>
                        <td class="text-center"><?php if ($lodge->is_grant == 1) {echo '<input class="my-3" type="radio" checked>';} ?>
                        <td class="py-4 col-lg-2 text-center"><?php foreach ($districts as $district) {if ($lodge->district_id == $district->id) {echo $district->title;}} ?></td>
                        <td class="text-center">
                          <?php if ($lodge->enable_bit == 1) : ?>
                            <a class="btn" type="button" onclick="btn_disable(this,<?php echo $lodge->id; ?>);" data-id="0" href="javascript:void(0);"><i class="simple-icon-check"></i></a>
                          <?php else : ?>
                            <a class="btn" type="button" onclick="btn_disable(this,<?php echo $lodge->id; ?>);" data-id="1" href="javascript:void(0);"><i class="iconsminds-close"></i></a>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a title="Edit" class="btn btn-icon" id="btnEdit" onclick="btn_update_detail(this,<?php echo $lodge->id; ?>);" href="javascript:void(0);"><i class="simple-icon-note" aria-hidden="true"></i></a>
                          <?php if ($lodge->delete_bit == 1) : ?>
                            <a title="Retore" class="btn btn-icon" id="btnRestore" onclick="btn_delete(this,<?php echo $lodge->id; ?>);" data-id="0" href="javascript:void(0);"><i class="simple-icon-action-undo" aria-hidden="true"></i></a>
                          <?php else : ?>
                            <a title="Delete" class="btn btn-icon" id="btnDelete" onclick="btn_delete(this,<?php echo $lodge->id; ?>);" data-id="1" href="javascript:void(0);"><i class="simple-icon-trash" aria-hidden="true"></i></a>
                          <?php endif; ?>
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
    <input type="hidden" id="callBackLoc" value="<?php echo base_url('Admin'); ?>" />

    <!--Page Scripts -->
    <script src="<?php echo base_url(); ?>Assets/js/custum/lodge_view.js"></script>
    <!-- Page-Level Scripts -->
  </div>
</div>