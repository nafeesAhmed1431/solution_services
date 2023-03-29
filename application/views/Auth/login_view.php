<style>
    html {
        background: #17a2b8 !important;
        height: 100%;
    }

    html::before {
        content: none !important;
    }
</style>
<?php include('auth_header.php'); ?>
<?php if (!empty($this->session->flashdata('msg'))) {
    echo "<div class='h5 alert alert-danger text-center'>" . $this->session->flashdata('msg') . "</div>";
} ?>
<div class="row h-100">
    <div class="col-8 col-md-8 mx-auto my-auto">
        <div class="card auth-card round_corner">
            <div class="form-side">
                <h1 class="mb-5">Servicios de Solución</h1>
                <h3 class="mb-4">Acceso</h3>
                <form action="Auth/login" method="POST">
                    <label class="form-group has-float-label mb-4">
                        <input type="text" name="username" class="form-control">
                        <span>Username</span>
                    </label>
                    <h1><?php echo form_error('username'); ?></h1>
                    <label class="form-group has-float-label mb-4">
                        <input class="form-control" name="password" type="password">
                        <span>Clave</span>
                    </label>
                    <?php echo form_error('password'); ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="#">Forget password?</a>
                        <button class="btn btn-primary btn-lg btn-shadow" type="submit">Acceso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include('auth_footer.php'); ?>
