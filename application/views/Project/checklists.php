<?php if (!empty($this->session->flashdata('msg'))) { ?>
  <?= $this->session->set_flashdata('msg', 'list Updated SuccessFully !!!'); ?>
<?php } ?>
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
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-12 text-right form-group">
                    <a class="btn btn-add pad add_checklist" href="javascript:void(0);"><i class="iconsminds-add" aria-hidden="true"></i>Add CheckList</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive mt-3">
                <table id="checklist_table" class="table icon_space dataTables-grd">
                  <thead>
                    <tr>
                      <th>Sr#</th>
                      <th>Title</th>
                      <th class="text-center">Enable</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody id="grd">
                    <?php foreach ($checklists as $checklist) : ?>
                      <tr>
                        <td><?= $checklist->id ?></td>
                        <td><?= $checklist->title ?></td>
                        <td class="text-center">
                          <a class="btn checklist_status" data-status="<?= $checklist->enable_bit ?>" data-clid="<?= $checklist->id ?>" type="button" href="javascript:void(0);"><i class="<?= $checklist->enable_bit == 1 ? "simple-icon-check" : "iconsminds-close"; ?>"></i></a>
                        </td>
                        <td class="text-center" data-clid="<?= $checklist->id ?>">
                          <a title="Edit" class="btn btn-icon edit_checklist"><i class="simple-icon-note" aria-hidden="true"></i></a>
                          <a title="Delete" class="btn btn-icon btnDelete"><i class="simple-icon-trash" aria-hidden="true"></i></a>
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
    <input type="hidden" id="base_url" value="<?= base_url() ?>" />
    <input type="hidden" id="process_id" value="<?= $process_id ?>" />
  </div>
</div>
<script src="<?= base_url('Assets/js/custum/checklist_view.js') ?>"></script>
<script src="<?= base_url('Assets/js/plugins/sweetalert2.js') ?>"></script>