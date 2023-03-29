<?php if (!empty($this->session->flashdata('msg'))) : ?>
    <div class="alert alert-warning alert-dismissible fade show rounded mb-3 " role="alert">
        <strong>Dear : <?= $this->session->userdata('username') ?></strong><?= $this->session->flashdata('msg');?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>
<?php $role=$this->session->userdata('role_id'); ?>
<div class="d-flex  justify-content-center">
    <div class="card col-lg-8 round_corner mb-5">
        <div class="card-body">
            <h2>Add New Member</h2>
            <hr>
            <form class=" mb-5" action="<?= base_url('Admin/add_new_user') ?>" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Full name</label>
                        <input type="text" class="form-control" name="full_name" placeholder="Full name" required value="<?=set_value('full_name')?>">
                        <p><?= form_error('full_name') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">User Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" name="user_name" placeholder="Username" required value="<?=set_value('user_name')?>">
                            <p><?= form_error('user_name') ?></p>
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
                            <input type="text" class="form-control" name="email" placeholder="Email" required value="<?=set_value('email')?>">
                            <p><?= form_error('email') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Gender</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-male-female"></span>
                            </div>
                            <select name="gender" class="form-control" required>
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">CNIC</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-id-card"></span>
                            </div>
                            <input type="number" class="form-control" name="cnic" placeholder="----/-----/-----" required value="<?=set_value('cnic')?>">
                            <p><?= form_error('cnic') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Image</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-photo"></span>
                            </div>
                            <input type="file" class="form-control" name="img">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Joining Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-calendar"></span>
                            </div>
                            <input type="date" class="form-control" name="joining_date" required value="<?=set_value('joining_date')?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Contact No</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-phone"></span>
                            </div>
                            <input type="value" class="form-control" name="contact" required value="<?=set_value('contact')?>">
                            <p><?= form_error('contact') ?></p>
                        </div>
                    </div>
                </div>
                
                <?php if($role == 1): ?>
                <div class="form-row">
                <div class="col-md-6 mb-3">
                        <label for="">Lodge</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-building"></span>
                            </div>
                            <select name="lodge_id" class="form-control" required>
                                <option value="" selected disabled>Select Lodge</option>
                                <?php foreach($lodges as $lodge):?>
                                    <option value="<?= $lodge->id ?>"><?= $lodge->title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">UserType</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-user"></span>
                            </div>
                            <select name="role" class="form-control" required>
                                <option value="" selected disabled>Select User Type</option>
                                <?php foreach($types as $type):?>
                                    <option value="<?= $type->id ?>"><?= $type->title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="form-row">
                    <div class="col-md-<?= ($role == 1)? 12 : 6; ?> mb-3">
                        <label for="">Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-location-pin"></span>
                            </div>
                            <input type="text" class="form-control" name="address" required value="<?=set_value('address')?>">
                        </div>
                    </div>
                    <?php if($role == 2): ?>
                    <div class="col-md-6 mb-3">
                        <label for="">UserType</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-user"></span>
                            </div>
                            <select name="role" class="form-control" required>
                                <option value="" selected disabled>Select User Type</option>
                                <option value="3">Secretary</option>
                                <option value="4">Member</option>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="">Seal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-badge "></span>
                            </div>
                            <select name="badge" class="form-control" required>
                                <option value="" selected disabled>Select User Seal</option>
                                <option value="1">Blue Seal</option>
                                <option value="2">White Seal</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-password "></span>
                            </div>
                            <input type="password" class="form-control" name="password" required value="<?=set_value('password')?>"><br>  
                            <p><?= form_error('password') ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-password"></span>
                            </div>
                            <input type="password" class="form-control" name="confirm_password" required value="<?=set_value('confirm_password')?>"><br>
                        </div>
                    </div>
                </div>
                <p><?= form_error('confirm_password') ?></p>
                <br>
                <button class="btn btn-block btn-primary" type="submit">Submit form</button>
            </form>
        </div>
    </div>
</div>