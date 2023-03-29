<div class="container-fluid disable-text-selection">
    <div class="row">
        <?php if (!empty($this->session->flashdata())) : ?>
            <div class="alert alert-<?=$this->session->flashdata('alert')?> alert-dismissible fade show rounded mb-3 " role="alert">
                <strong>Dear : <?= $this->session->userdata('username') ?></strong> <?= $this->session->flashdata('msg');?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card mb-4 round_corner d-card total">
                <a href="<?= base_url('Projects') ?>" class="card-body justify-content-between d-flex flex-row align-items-center">
                    <div>
                    <i class="iconsminds-project mr-2 icon_large"></i>
                        <div class="dash-cards-text">
                            <p class="text-medium ">Proyectos totales</p>
                        </div>
                    </div>
                    <div class="dash-card-nmbr">
                        <div class="position-relative">
                            <h1 class="font_large" id="total"><?= $projects ?></h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-4 round_corner d-card archived">
                <a href="<?= base_url('Archived') ?>" class="card-body justify-content-between d-flex flex-row align-items-center">
                    <div>
                        <i class="iconsminds-download-1 mr-2 icon_large"></i>
                        <div class="dash-cards-text">
                            <p class="text-medium">Archivado proyectos</p>
                        </div>
                    </div>
                    <div class="dash-card-nmbr">
                        <div class="position-relative">
                        <h1 class="font_large" id="archived"><?= $archived ?></h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-4 round_corner d-card completed">
                <a href="<?= base_url('Completed') ?>" class="card-body justify-content-between d-flex flex-row align-items-center">
                    <div>
                    <i class="iconsminds-check mr-2 icon_large"></i>
                        <div class="dash-cards-text">
                            <p class="text-medium">Terminado proyectos</p>
                        </div>
                    </div>
                    <div class="dash-card-nmbr">
                        <div class="position-relative">
                            <h1 class="font_large" id="completed"><?= $completed ?></h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mb-4 round_corner d-card underConstruction">
                <a href="<?= base_url('Projects') ?>" class="card-body justify-content-between d-flex flex-row align-items-center">
                    <div>
                    <i class="iconsminds-shopping-cart mr-2 icon_large"></i>
                        <div class="dash-cards-text">
                            <p class="text-medium ">Under Construction</p>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="dash-card-nmbr">
                        <div class="position-relative">
                            <h1 class="font_large" id="total"><?=$underConstruction->underConstruction?$underConstruction->underConstruction:"";?></h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card round_corner">
                <div class="card-body ">
                    <h5 class="card-title">Proyectos</h5>
                    <div class="dashboard-line-chart">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4 mb-4 ">
            <div class="card h-100 round_corner">
                <div class="card-body">
                    <h5 class="card-title">Visión general</h5>
                    <div class="dashboard-donut-chart">
                        <canvas id="polarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input id="polarData" hidden data-completed="<?= $completed ?>" data-archived="<?= $archived ?>" data-total="<?= $projects?>">
<script src="<?= base_url('Assets/js/custum/custom_charts.js'); ?>?v=1.1"></script>
