<style>
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-top-margin {
        margin-top: -40px;
    }

    .card-top-margin-md {
        margin-top: -25px;
    }

    .text-md {
        font-size: 25px;
    }

    .icon-md {
        font-size: 15px;
    }

    .arrow {
        position: relative;
        top: 2px;
        left: -10px;
    }
</style>
<div class="container-fluid disable-text-selection">
    <div class="col-12 list" data-check-all="checkAll">
        <?php if ($load_data == 1) : ?>
            <div class="card-body">
                <h2><?= $pageHeading ?> : " <?= ucwords($project[0]->project_name) ?> "</h2>
                <hr>
            </div>
            <div class="row flex-nowrap card-row">
                <?php $gpm = 0;
                $gpc = 0;
                foreach ($lists as $list) : $max = 0;
                    $curr = 0; ?>
                    <div class="card card-1 position-relative col-sm-4 round_corner round_corner2 mb-3">
                        <div class="card-header mt-3">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h6 class="overFlowTitle" data-toggle="tooltip" data-placement="top" data-original-title="<?= $list->title ?>"><?= $list->title ?></h6>
                                </div>
                                <div class="col-sm-2">
                                    <span class="text-large">
                                        <i data-toggle="tooltip" data-placement="top" data-original-title="Notificar Empresa" data-lid="<?= $list->id ?>" class="fa-regular fa-bell text-right w-100 text-warning list_notify"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-top-margin">
                            <p class="list-item-heading">
                            <div class="accordion">
                                <?php foreach ($documents as $document) : ?>
                                    <?php if ($document->checklists_list_id == $list->id) : ?>
                                        <div class="card mb-3 shadow">
                                            <div class="card-header pt-3 text-truncate bg-light">
                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#<?= $document->id ?>">
                                                    <div class="row">
                                                        <div class="col-10 overflow">
                                                            <i class="simple-icon-arrow-down arrow"></i>
                                                            <span class="" title="<?= $document->title ?>"><?= $document->title ?></span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span title="Click to view Details" class="badge badge-light">
                                                                <i class=" text-sm <?= (!empty($document->file_name)) ? "simple-icon-check text-success" : "simple-icon-clock text-danger"; ?>"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                            <div id="<?= $document->id ?>" class="collapse">
                                                <div class="card-body mt-2">
                                                    <div class="row mb-4">
                                                        <div class="col-6">
                                                            <label for="">Notified at:</label>
                                                            <input type="date" class="form-control date1" disabled value="<?= $document->date_1 ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="">Received at:</label>
                                                            <input type="date" class="form-control date2" disabled value="<?= $document->date_2 ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="">Document Comments:</label>
                                                            <textarea class="form-control comment" rows="6" disabled placeholder="Comments"><?= $document->comments ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer d-flex justify-content-center">
                                                    <?php if (!empty($document->file_name)) : ?>
                                                        <span class="badge badge-light">
                                                            <a class="text-small text-success" target="_blank" href="<?= base_url('Assets/docs/') . $document->file_name ?>">Ver Documento</a>
                                                        </span>
                                                        <?php $curr++;
                                                        $gpc++; ?>
                                                    <?php else : ?>
                                                        <span class="text-small text-danger">No hay documentos Subidos</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $max++;
                                        $gpm++;
                                    endif; ?>
                                <?php endforeach; ?>
                            </div>
                            </p>
                            <footer>
                                <?php if (!empty($max)) : ?>
                                    <?php if ((($curr / $max) * 100) != 0) : ?>
                                        <div class="progress progress1 mt-3">
                                            <div title="<?= intval((($curr / $max) * 100)) . "%" ?>" class="progress-bar bg-<?php if ((($curr / $max) * 100) < 50) {
                                                                                                                                echo "danger";
                                                                                                                            } elseif ((($curr / $max) * 100) < 80) {
                                                                                                                                echo "warning";
                                                                                                                            } else {
                                                                                                                                echo "success";
                                                                                                                            } ?>" style="width: <?= (($curr / $max) * 100) ?>%;"><?= intval((($curr / $max) * 100)) ?>%</div>
                                        </div>
                                    <?php else : ?>
                                        <!-- <p class="round_corner text-center p-1 text-danger text-small">No hay documentos Subidos</p> -->
                                    <?php endif; ?>
                                <?php endif; ?>
                            </footer>
                        </div>
                    </div>
                <?php endforeach;  ?>
            </div>
            <?php if (!empty($max)) : ?>
                <div class="mt-3">
                    <div title="<?= intval((($gpc / $gpm) * 100)) . "%" ?>" class="progress-bar grnd-progress-bar row  bg-<?php if ((($gpc / $gpm) * 100) < 50) {
                                                                                                                                echo "danger";
                                                                                                                            } elseif ((($gpc / $gpm) * 100) < 80) {
                                                                                                                                echo "warning";
                                                                                                                            } else {
                                                                                                                                echo "success";
                                                                                                                            } ?>" style="width: <?= (($gpc / $gpm) * 100) ?>%;"><?= intval((($gpc / $gpm) * 100)) ?>%</div>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="text-large text-center text-info"><?= $page_text; ?></div>
        <?php endif; ?>
    </div>
</div>
<script src="http://localhost/solution_services/Assets/js/jquery-3.3.1.min.js"></script>
<script>
    var base_url = '<?= base_url() ?>';
    $('.collapsed').click(function() {
        $(this).find('.arrow').toggleClass('simple-icon-arrow-down simple-icon-arrow-up');
    });
</script>