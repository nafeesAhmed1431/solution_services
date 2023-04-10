<link rel="stylesheet" href="<?= base_url('Assets/css/profile_card.css'); ?>" />

<div class="container-fluid disable-text-selection">
    <div class="col-12 " data-check-all="checkAll">
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
                            <div class="row">
                                <?php foreach ($users as $user) : ?>
                                    <div class="col-4">
                                        <div class="card p-3 rounded_md">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="<?= base_url('Assets/img/profile/profile.jpg') ?>" class="rounded_md" width="155">
                                                </div>
                                                <div class="ml-3 w-100">
                                                    <h4 class="mb-0 mt-0"><?= ucwords($user->full_name) ?></h4>
                                                    <span><?= ucwords($user->email) ?></span>
                                                    <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded_md text-white stats">
                                                        <div class="d-flex flex-column">
                                                            <span class="articles">Contact</span>
                                                            <span class="number1"><?= $user->contact ?></span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="rating">Role</span>
                                                            <span class="number3"><?= $user->role_title ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="button mt-2 d-flex flex-row align-items-center justify-content-center">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button type="button" class="btn btn-outline-primary"><i class="simple-icon-check"></i></button>
                                                            <button type="button" class="btn btn-outline-success"><i class="iconsminds-folder-edit"></i></button>
                                                            <button type="button" class="btn btn-outline-danger"><i class="simple-icon-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    <!-- <button class="btn btn-sm btn-outline-primary w-100">Chat</button>
                        <button class="btn btn-sm btn-primary w-100 ml-2">Follow</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
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