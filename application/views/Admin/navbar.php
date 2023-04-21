<style>
    .dropdown-menu-right {
        font-size: 15px;
    }

    .icon_dropdown {
        font-size: 20px;
    }
</style>
<nav class="navbar fixed-top p-0 py-md-3">

    <div class="d-flex align-items-center col-2 col-md-1 p-0 px-md-3">

        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>

            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1" />
                <rect x="1.56" y="7.5" width="16" height="1" />
                <rect x="1.56" y="15.5" width="16" height="1" />
            </svg>
        </a>

        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1" />
                <rect x="0.5" y="7.5" width="25" height="1" />
                <rect x="0.5" y="15.5" width="25" height="1" />
            </svg>
        </a>


    </div>


    <a class="navbar-logo col-md-5 col-7 p-0 px-md-3" href="#">
        <img src="<?php echo base_url('Assets/img/ss-logo.png') ?>" alt="" width="200px">
    </a>

    <div class="col-md-3 d-none d-md-block">
        <form action="">
            <div class="searchInput">
                <input type="search" name="mainsearchbar" class="mainsearchbar">
                <button type="submit"><img src="<?= base_url('Assets/img/admin/search.svg') ?>" alt="" width="17px" height="17px"></button>
            </div>
        </form>
    </div>

    <div class="navbar-right col-md-3">
        <div class="header-icons d-inline-block align-middle">
            <?php // if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) : 
            ?>
            <!-- <div class="position-relative d-none d-sm-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown">
                        <a href="#" class="icon-menu-item">
                            <i class="iconsminds-equalizer d-block"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                </div> -->
            <?php // endif; 
            ?>

            <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                <i class="simple-icon-size-fullscreen"></i>
                <i class="simple-icon-size-actual"></i>
            </button>

        </div>

        <div class="user d-inline-block p-0 pr-md-3">
            <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="name"><?= $this->session->userdata('username') ?></span>
                <span>
                    <img alt="Avatar" src="<?= base_url('Assets/img/profile/') . $this->session->userdata('img') ?>" />
                </span>
            </button>

            <div class="dropdown-menu dropdown-menu-right mt-3">
                <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <?php print_r(''); ?>
                <?php } else { ?>
                    <a class="dropdown-item view_profile" href="javascript:void(0)"> <i class="icon_dropdown iconsminds-profile"></i> Perfil</a>
                <?php } ?>
                <a class="dropdown-item view_profile" href="javascript:void(0)"><i class="icon_dropdown iconsminds-profile"></i> Perfil</a>
                <a class="dropdown-item" href="<?= base_url('changePassword') ?>"><i class="icon_dropdown iconsminds-key"></i> Cambia contraseña</a>
                <a class="dropdown-item" href="<?= base_url('settings') ?>"><i class="icon_dropdown simple-icon-settings"></i> Settings</a>
                <a class="dropdown-item" href="<?= base_url('Auth/logout') ?>"><i class="icon_dropdown simple-icon-login"></i> Cerrar sesión</a>
            </div>
        </div>

    </div>
</nav>