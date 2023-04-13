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

    .add_document {
        position: absolute;
        top: -25px;
        left: 13px;
    }
</style>
<div class="card-body">
    <h2><?= $pageHeading ?> : " <?= $project[0]->project_name ?> "</h2>
    <hr>
</div>
<input type="hidden" id="pid" value="<?= $pid ?>">
<div class="row flex-nowrap card-row">
    <?php $gpm = 0;
    $gpc = 0;
    $list_percentages = [];
    foreach ($lists as $list) : $max = 0;
        $curr = 0; ?>
        <div class="card card-1 position-relative col-sm-4 round_corner round_corner2 mb-3 card-list" data-list_id="<?= $list->id ?>">
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
                <div class="row">
                    <div class="col-12 col-document"></div>
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
                                                <span class="" data-toggle="tooltip" data-placement="left" data-original-title="<?= $document->title ?>"><?= $document->title ?></span>
                                            </div>
                                            <div class="col-2">
                                                <i class=" text-md <?= (!empty($document->file_name)) ? "simple-icon-check text-success" : "simple-icon-clock text-danger"; ?>"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                                <div id="<?= $document->id ?>" class="collapse">
                                    <div class="card-body card-top-margin-md">
                                        <?php if (empty($document->file_name)) : ?>
                                            <i data-toggle="tooltip" data-placement="right" data-original-title="Notificar Empresa" class="fa-regular fa-bell text-right icon-md w-100 text-warning" data-pid="<?= $project[0]->id ?>" data-lid="<?= $list->id ?>" data-clid="<?= $document->id ?>" onclick="notify(this)"></i>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-group has-float-label mb-1">
                                                    <input type="file" data-checklist_id="<?= $document->id ?>" data-list_id="<?= $list->id ?>" data-project_id="<?= $project[0]->id ?>" class="form-control" onchange="upload_file(this)">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-6"><input type="date" class="form-control date1" value="<?= $document->date_1 ?>" data-checklist_id="<?= $document->id ?>"></div>
                                            <div class="col-6"><input type="date" class="form-control date2" value="<?= $document->date_2 ?>" data-checklist_id="<?= $document->id ?>"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <textarea data-checklist_id="<?= $document->id ?>" class="form-control comment" rows="6" placeholder="Comments"><?= $document->comments ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <?php if (!empty($document->file_name)) : ?>
                                        <a class="text-small text-muted" target="_blank" href="<?= base_url('Assets/docs/') . $document->file_name ?>">Ver Documento</a>
                                        <?php $curr++;
                                        $gpc++; ?>
                                    <?php else : ?>
                                        <span class="text-small text-muted">No hay documentos Subidos</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php $max++;
                            $gpm++;
                        endif; ?>
                    <?php endforeach; ?>
                </div>
                </p>
                <footer>
                    <?php if (empty($max)) { ?>
                        <?php print_r(''); ?>
                    <?php } else { ?>
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
                            <p class="round_corner text-center p-1 text-danger text-small">No hay documentos Subidos</p>
                        <?php endif; ?>
                    <?php } ?>
                </footer>
            </div>
        </div>
        <?php $list_percentages[$list->id] = intval((($curr / $max) * 100)); ?>
    <?php endforeach;  ?>
</div>
<?php if (empty($max)) { ?>
    <?php print_r(''); ?>
<?php } else { ?>
    <div class="mt-3">
        <div title="<?= intval((($gpc / $gpm) * 100)) . "%" ?>" class="progress-bar grnd-progress-bar row  bg-<?php if ((($gpc / $gpm) * 100) < 50) {
                                                                                                                    echo "danger";
                                                                                                                } elseif ((($gpc / $gpm) * 100) < 80) {
                                                                                                                    echo "warning";
                                                                                                                } else {
                                                                                                                    echo "success";
                                                                                                                } ?>" style="width: <?= (($gpc / $gpm) * 100) ?>%;"><?= intval((($gpc / $gpm) * 100)) ?>%</div>
    </div>
<?php } ?>

<script>
    var list_percentages = JSON.parse('<?= json_encode($list_percentages) ?>');
</script>
<script src="<?= base_url('Assets/js/custum/project_details_view.js'); ?>"></script>
<script src="<?= base_url('Assets/js/plugins/sweetalert2.js'); ?>"></script>