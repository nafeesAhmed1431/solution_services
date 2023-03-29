<div class="row mt-5">
    <div class="col-8 col-md-6 mx-auto my-auto">
        <div class="card auth-card round_corner">
            <div class="card-body">
                <h1 class="mb-4">Change Password : <?= $this->session->userdata('username')?></h1>
                <?php if(!empty($this->session->flashdata('msg'))):?>
                    <div class="row">
                        <div class="col-lg-12 text-center mb-3 text-danger">
                            <h3><?= $this->session->flashdata('msg')?></h3>
                        </div>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('Auth/change_password')?>" method="POST">
                    <label class="form-group has-float-label">
                        <input type="text" class="form-control" name="oldPassword" value="<?= set_value('oldPassword')?>" placeholder="Enter Your Old Password here" required>
                        <span>Old Password</span>
                    </label>
                    <span class="text-danger"><?= form_error('oldPassword')?></span>
                    <label class="form-group has-float-label">
                        <input type="text" class="form-control"  name="password" placeholder="Enter New Password here !!!" required>
                        <span>New Password</span>
                    </label>
                    <span class="text-danger"><?= form_error('password')?></span>

                    <label class="form-group has-float-label">
                        <input type="text" class="form-control"  name="confirmPassword" placeholder="Re-Type Password here !!!" required>
                        <span>Confirm Password</span>
                    </label>
                    <span class="text-danger"><?= form_error('confirmPassword')?></span>
                    <?php if( $success == false): ?>
                        <button class="btn btn-warning btn-block" type="submit">Update Password</button>
                    <?php endif; ?>
                </form>
                <?php if( $success == false): ?>
                    <a href="<?= base_url('Dashboard');?>" class="btn btn-primary btn-block my-2">Cancel</a>
                <?php endif; ?>
                <?php if(!empty($success) && $success == true): ?>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <a class="btn btn-danger btn-block" href="<?=base_url('Auth/logout')?>">Logout</a>
                            </div>
                            <div class="col-lg-6">
                            <a class="btn btn-info btn-block" href="<?=base_url('Dashboard')?>">Goto Dashboard</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>