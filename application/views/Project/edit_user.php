<div class="d-flex  justify-content-center">
    <div class="card col-lg-8 round_corner mb-5">
        <div class="card-body">
            <h2><?= $pageHeading ?></h2>
            <hr>
            <form class=" mb-5" action="<?= base_url('Admin/update_user') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= !empty($user[0]->id) ? $user[0]->id :'' ?>">

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Full Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="<?= (empty($user))? set_value('Full Name') : $user[0]->full_name ; ?>">
                        </div>
                        <p class="text-danger"><?= form_error('full_name') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">User Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" placeholder="User Name" value="<?= (empty($user))? set_value('User Name') : $user[0]->user_name ; ?>" readonly>
                        </div>
                        <p class="text-danger"><?= form_error('User_name') ?></p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-envelope"></span>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Email"   value="<?= (empty($user))? set_value('Email') : $user[0]->email ; ?>">
                        </div>
                        <p class="text-danger"><?= form_error('email') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Gender</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-male-female"></span>
                            </div>
                            <select name="gender" class="form-control" required>
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">Theme</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-male-female"></span>
                            </div>
                            <select name="theme" class="form-control" required>
                                <option selected disabled>Select Theme</option>
                                <option value="0">Classic Theme</option>
                                <option value="1">Solution Services Theme</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">CNIC</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text iconsminds-id-card"></span>
                            </div>
                            <input type="number" class="form-control" name="cnic" placeholder="----/-----/-----" required value="<?= (empty($user))? set_value('CNIC') : $user[0]->cnic ; ?>">
                            <p><?= form_error('cnic') ?></p>
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
                            <input type="value" class="form-control" name="contact" required value="<?= (empty($user))? set_value('Contact Number') : $user[0]->contact ; ?>">
                            <p><?= form_error('contact') ?></p>
                        </div>
                    </div>
                    <div class="col-md mb-3">
                        <label for="">Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text simple-icon-location-pin"></span>
                            </div>
                            <input type="text" class="form-control" name="address" required value="<?= (empty($user))? set_value('Address') : $user[0]->address ; ?>">
                        </div>
                    </div>
                </div>
                <p><?= form_error('confirm_password') ?></p>
                <br>
                <button class="btn btn-block btn-primary" type="submit">Submit</button>
                <a href="<?= base_url('Users') ?>" class="btn btn-block btn-danger" >Cancel</a>
            </form>
            
        </div>
    </div>
</div>