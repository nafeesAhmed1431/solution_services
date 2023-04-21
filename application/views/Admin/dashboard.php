<div class="container-fluid disable-text-selection">
    <div class="row">
        <?php if (!empty($this->session->flashdata())) : ?>
            <div class="alert alert-<?= $this->session->flashdata('alert') ?> alert-dismissible fade show rounded mb-3 " role="alert">
                <strong>Dear : <?= $this->session->userdata('username') ?></strong> <?= $this->session->flashdata('msg'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="dashboardCard">
                <a href="<?= base_url('Project') ?>" class=" justify-content-between d-flex flex-row align-items-center beforeStyling">
                    <div>
                        <h1 class="font_large" id="total"><?= $projects ?></h1>
                        <div class="dash-cards-text">
                            <p class="text-medium ">Proyectos totales</p>
                        </div>
                    </div>
                    <div class="dash-card-nmbr">
                        <div class="position-relative">
                            <i class="iconsminds-project icon_large"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="dashboardCard">
                <a href="<?= base_url('Project') ?>" class=" justify-content-between d-flex flex-row align-items-center beforeStyling archivado">
                    <div>
                        <h1 class="font_large" id="archived"><?= $archived ?></h1>
                        <div class="dash-cards-text">
                            <p class="text-medium">Archivado proyectos</p>
                        </div>
                    </div>
                    <div class="dash-card-nmbr">
                        <div class="position-relative">
                            <i class="iconsminds-download-1 icon_large"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="dashboardCard">
                <a href="<?= base_url('Project') ?>" class=" justify-content-between d-flex flex-row align-items-center beforeStyling terminado">
                    <div>
                        <h1 class="font_large" id="completed"><?= $completed ?></h1>
                        <div class="dash-cards-text">
                            <p class="text-medium">Terminado proyectos</p>
                        </div>
                    </div>
                    <div class="dash-card-nmbr">
                        <div class="position-relative">
                            <i class="iconsminds-check icon_large"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="dashboardCard">
                <a href="<?= base_url('Project') ?>" class=" justify-content-between d-flex flex-row align-items-center beforeStyling under">
                    <div>
                        <h1 class="font_large" id="total"><?= $underConstruction->underConstruction ? $underConstruction->underConstruction : ""; ?></h1>
                        <div class="dash-cards-text">
                            <p class="text-medium ">Under Construction</p>
                        </div>
                    </div>
                    <div class="dash-card-nmbr">
                        <div class="position-relative">
                            <i class="iconsminds-shopping-cart icon_large"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card round_corner">
                <div class="card-body ">
                    <h5 class="card-title">Graph</h5>
                    <div class="dashboard-line-chart">
                        <div id="myChart" style="width:100%;max-width:500px"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 ">
            <div class="card h-100 round_corner">
                <div class="card-body">
                    <h5 class="card-title">Projects</h5>
                    <div class="dashboard-donut-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="card round_corner">
                <div class="card-body ">
                    <h5 class="card-title backchange">Overview</h5>
                    <div class="dashboard-line-chart">
                        <canvas id="salesChart" style="width:100%;max-width:600px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('Assets/charts/chart.min.js') ?>"></script>
<script src="<?= base_url('Assets/charts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('Assets/js/custum/custom_charts.js'); ?>"></script>