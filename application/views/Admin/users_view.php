<?php if (!empty($this->session->flashdata('msg'))) : ?>
  <div class="alert alert-warning alert-dismissible fade show rounded mb-3 " role="alert">
    <strong>Dear : <?= $this->session->userdata('username') ?></strong><?= $this->session->flashdata('msg'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
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
              <!-- <h3 class="box-title">Data Table With Full Features</h3>-->
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <?php if ($this->session->userdata('role_id') == 2 || $this->session->userdata('role_id') == 1) : ?>
                  <div class="col-lg-12 text-right form-group">
                    <a class="btn btn-add pad" href="<?= base_url('NewUser'); ?>"><i class="iconsminds-add" aria-hidden="true"></i>Add User</a>
                  </div>
                <?php endif; ?>
              </div>
              <div class="table-responsive">
                <table id="grd" class="table icon_space dataTables-grd">
                  <thead>
                    <tr>
                      <th class="text-center">Sr</th>
                      <th>Last Login</th>
                      <th>Full Name</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th class="text-center">Role</th>
                      <th class="text-center">Enable</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody id="grd">
                    <?php foreach ($users as $user) : ?>
                      <tr>
                        <td class="text-center"><?= $user->id ?></td>
                        <td class="col-lg-1"><?php if (empty($user->last_login)) {echo "Not Logged in Yet";} else {echo $user->last_login;} ?></td>
                        <td><?= $user->full_name ?></td>
                        <td><?= $user->user_name ?></td>
                        <td><?= $user->email ?></td>
                        <td class="text-center"><?php foreach ($roles as $role) : ?>
                            <?php if ($user->role_id == $role->id) : ?>
                              <span class="badge badge-pill badge-<?= $role->diff_bit; ?> my-2"><?= $role->title ?></span>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </td>
                        <td class="text-center">
                          <?php if (!($user->role_id == 1 || $this->session->userdata['role_id'] == $user->role_id)) : ?>
                            <?php if ($user->enable_bit == 1) : ?>
                              <a class="btn" type="button" onclick="btn_disable(this,<?php echo $user->id; ?>);" data-id="0" href="javascript:void(0);"><i class="simple-icon-check"></i></a>
                            <?php else : ?>
                              <a class="btn" type="button" onclick="btn_disable(this,<?php echo $user->id; ?>);" data-id="1" href="javascript:void(0);"><i class="iconsminds-close"></i></a>
                            <?php endif; ?>
                          <?php else : ?>
                            <a class="btn" type="button" onclick="isAdmin()"><i class="iconsminds-administrator"></i></a>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <?php if (!($user->role_id == 1 || $this->session->userdata['role_id'] == $user->role_id)) : ?>
                            <a title="Edit" class="btn btn-icon" id="btnEdit" href="<?= base_url('EditUser/') . $user->id; ?>"><i class="simple-icon-note" aria-hidden="true"></i></a>
                            <?php if ($user->delete_bit == 1) : ?>
                              <a title="Retore" class="btn btn-icon" id="btnRestore" onclick="btn_delete(this,<?php echo $user->id; ?>);" data-id="0" href="javascript:void(0);"><i class="simple-icon-action-undo" aria-hidden="true"></i></a>
                            <?php else : ?>
                              <a title="Delete" class="btn btn-icon" id="btnDelete" onclick="btn_delete(this,<?php echo $user->id; ?>);" data-id="1" href="javascript:void(0);"><i class="simple-icon-trash" aria-hidden="true"></i></a>
                            <?php endif; ?>
                          <?php else : ?>
                            <a class="btn btn-block" onclick="is('<?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) {echo 'Admin';} else { echo  'Secretary';} ?>')"><?= ($user->role_id == 3) ? "Is Secretary" : "Is Admin "; ?></a>
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
    <input type="hidden" id="callBackLoc" value="<?php echo base_url('admin'); ?>" />
    <!--Page Scripts -->
    <script src="<?= base_url('Assets/js/custum/user_view.js'); ?>"></script>
  </div>
</div>