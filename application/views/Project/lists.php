<?php if(!empty($this->session->flashdata('msg'))) {?>
      <?= $this->session->set_flashdata('msg','list Updated SuccessFully !!!');?>
  <?php }?>
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
                              <a class="btn btn-add pad" href="<?=base_url('Process')?>">Process</a>
                              <a class="btn btn-add pad" href="javascript:void(0);" onclick="add_list()"><i class="iconsminds-add" aria-hidden="true"></i>Add List</a>
                            </div>
                          </div>
                    </div>
                          <div class="table-responsive mt-3">
                          <table id="grd" class="table icon_space dataTables-grd">
                              <thead>
                                <tr>
                                  <th>Sr#</th>
                                  <th>Title</th>
                                  <th class="text-center">Enable</th>
                                  <th class="text-center">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($lists as $list): ?>
                                <tr>
                                  <td><?= $list->id ?></td>
                                  <td><?= $list->title ?></td>

                                  <td class="text-center">
                                    <?php if ($list->enable_bit == 1) : ?>
                                      <a class="btn" type="button" onclick="btn_list_disable(this,<?php echo $list->id; ?>);" data-id="0" href="javascript:void(0);"><i class="simple-icon-check"></i></a>
                                    <?php else : ?>
                                      <a class="btn" type="button" onclick="btn_list_disable(this,<?php echo $list->id; ?>);" data-id="1" href="javascript:void(0);"><i class="iconsminds-close"></i></a>
                                    <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                      <a title="Edit" class="btn btn-icon" id="btnEdit" onclick="btn_update_list_detail(this,<?php echo $list->id; ?>);" href="javascript:void(0);"><i class="simple-icon-note" aria-hidden="true"></i></a>
                                      <?php if ($list->delete_bit == 1) : ?>
                                        <a title="Retore" class="btn btn-icon" id="btnRestore" onclick="btn_delete_list(this,<?php echo $list->id; ?>);" data-id="0" href="javascript:void(0);"><i class="simple-icon-action-undo" aria-hidden="true"></i></a>
                                      <?php else : ?>
                                        <a title="Delete" class="btn btn-icon" id="btnDelete" onclick="btn_delete_list(this,<?php echo $list->id; ?>);" data-id="1" href="javascript:void(0);"><i class="simple-icon-trash" aria-hidden="true"></i></a>
                                      <?php endif; ?>
                                        <a title="View" class="btn btn-icon" data-id="1" href="<?= base_url('Admin/checklist_details/' . $list->id); ?>"><i class="simple-icon-eye" aria-hidden="true"></i></a>
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
  </div>
</div>

    
