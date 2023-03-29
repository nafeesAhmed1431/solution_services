<div class="d-flex  justify-content-center">
    <div class="card col-lg-8 round_corner ">
        <div class="card-header mt-3">
            <?php if (!empty($this->session->flashdata())) : ?>
                <div class="alert alert-<?=$this->session->flashdata('alert')?> alert-dismissible fade show rounded mb-3 " role="alert">
                    <strong>Dear : <?= $this->session->userdata('username') ?></strong> <?= $this->session->flashdata('msg');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <h2>Update Profile</h2>
            <hr>
            <form class=" mb-5" action="<?php echo base_url('Admin/update_profile')?>" method="POST" enctype="multipart/form-data">
                <input hidden name="id" value="<?= $user[0]->id; ?>">
                <div class="form-row d-flex justify-content-center">
                    <div class="mb-3">
                        <img style="max-height:150px; max-width:150px; border-radius:100px;" src="<?= base_url('Assets/img/profile/').$user[0]->img;?>" alt="<?= $this->session->userdata('username')."'s Pic"?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Full name</label>
                        <input type="text" class="form-control" name="full_name" placeholder="Full name" required value="<?php if(!empty(set_value('full_name'))){echo set_value('full_name');}else{echo $user[0]->full_name;} ?>">
                        <p class="text-danger"><?= form_error('full_name') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">User Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" name="user_name" disabled placeholder="Username" value="<?php echo $user[0]->user_name;?>">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-envelope"></span>
                            </div>
                            <input type="text" class="form-control" name="email" disabled placeholder="Email" value="<?php echo $user[0]->email;?>">
                            <p><?= form_error('email') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Image</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-photo"></span>
                            </div>
                            <input type="file" class="form-control file-upload" name="img">
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Contact No</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-phone"></span>
                            </div>
                            <input type="number" class="form-control" name="contact" required value="<?php if(!empty(set_value('contact'))){echo set_value('contact');}else{echo $user[0]->contact;} ?>">
                            <p><?= form_error('contact') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-location-pin"></span>
                            </div>
                            <input type="text" class="form-control" name="address" required value="<?php if(!empty(set_value('address'))){echo set_value('address');}else{echo $user[0]->address;} ?>">
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn btn-block btn-danger" type="submit">Update</button>
            </form>
            <a href="<?= base_url('Dashboard') ?>" class="btn btn-block btn-primary" >Cancel</a>
        </div>
    </div>
</div>