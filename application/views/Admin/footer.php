</div>

<div class="modal fade" id="profile_model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">My Profile. </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img alt="Profile" id="profile_img" src="" class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail">
                    <p><span class="list-item-heading mb-1" id="profile_username"></span></p>
                    <p><span class="" id="profile_role"></span></p>
                    <p><span class="" id="profile_email"></span></p>
                    <p><span class="" id="profile_gender"></span></p>
                    <p><span class="" id="profile_contact"></span></p>
                    <p><span class="" id="profile_last_login"></span></p>
                </div>
                <div class="d-flex justify-content-around">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="base_url" value="<?= base_url(); ?>">
</main>
<!-- <script src="<= base_url('Assets/js/vendor/Chart.bundle.min.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/chartjs-plugin-datalabels.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/moment.min.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/fullcalendar.min.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/perfect-scrollbar.min.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/owl.carousel.min.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/progressbar.min.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/jquery.barrating.min.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/select2.full.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/nouislider.min.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/bootstrap-datepicker.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/Sortable.js'); ?>"></script> -->
<!-- <script src="<= base_url('Assets/js/vendor/mousetrap.min.js'); ?>"></script> -->
<script src="<?= base_url('Assets/js/vendor/datatables.min.js'); ?>"></script>
<script src="<?= base_url('Assets/js/vendor/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('Assets/js/dore.script.js'); ?>"></script>
<script src="<?= base_url('Assets/js/scripts.js'); ?>"></script>
<script src="<?= base_url('Assets/js/scripts.single.theme.js'); ?>"></script>
<script src="<?= base_url('Assets/js/plugins/sweetalert/sweetalert2.0.min.js'); ?>"></script>

<!-- Custom Js Files -->
<script>
    let base_url = $("#base_url").val();
    $.fn.dataTable.ext.errMode = 'none';
</script>
<script>
    $('.view_profile').on('click', function() {
        $.ajax({
            url: "<?= base_url('Admin/myInfo') ?>",
            method: 'POST',
            dataType: 'JSON',
            success: res => {
                $('#profile_img').attr('src', '<?= base_url('assets/img/profile/') ?>' + res.user.img);
                $('#profile_username').text(res.user.full_name);
                $('#profile_role').text(res.user.job_title);
                $('#profile_email').text(res.user.email);
                $('#profile_gender').text(res.user.gender);
                $('#profile_contact').text(res.user.contact);
                $('#profile_last_login').text(res.user.last_login);
            }
        });
        $('#profile_model').modal('show');
    });
</script>
<script src="<?= base_url('Assets/js/custum/data_table.js'); ?>?v=1.1"></script>

</body>

</html>