<style>
    .text-truncate {
        white-space: nowrap;
        width: 80%;
        overflow: hidden;
        text-overflow: ellipsis
    }

    .main-list-bell {
        font-size: 30px;
        position: relative;
        top: 7px;
        right: 13px;
        cursor: pointer;
    }

    .checklist-bell {
        font-size: 15px;
        cursor: pointer;
    }

    .card-top-margin {
        margin-top: -40px;
    }

    .card-top-margin-md {
        margin-top: -25px;
    }

    .text-md {
        font-size: 15px;
    }

    .icon-md {
        font-size: 15px;
    }

    .add_document {
        position: absolute;
        top: 11px;
        right: 25px;
    }

    .checklist-status {
        position: relative;
        top: 5px;
    }

    .list-card {
        min-height: 500px;
    }
</style>
<input type="hidden" id="pid" value="<?= $pid ?>">
<div class="container-fluid disable-text-selection">
    <section class="content-header mb-5">
        <h1 class="ml-0 text-large"><?= $pageHeading ?? "NULL"; ?></h1>
    </section>
    <section class="container">
        <div class="row flex-nowrap card-row">
            <?php
            $gt = 0;
            $go = 0;
            $list_percentages = [];
            $lists = array();

            foreach ($records as $record) {
                $list_title = $record->list_title;
                if (!isset($lists[$list_title])) {
                    $lists[$list_title] = array();
                }
                $lists[$list_title][] = $record;
                $list_ids[$list_title] = $record->list_id;
            } ?>

            <?php foreach ($lists as $key => $records) : $ct = 0;
                $co = 0; ?>
                <div class="col-5 mb-2">
                    <div class="card round_corner mt-2 list-card" data-lid="<?= $list_ids[$key] ?>">
                        <div class=" d-flex justify-content-between">
                            <h2 class="card-header mt-2 text-truncate" data-toggle="tooltip" data-placement="top" data-original-title="<?= $key ?>">
                                <?= $key ?>
                            </h2>
                            <div class="list_options">
                                <i class="fa-regular fa-bell text-warning list_notify main-list-bell" data-lid="<?= $list_ids[$key] ?>"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            $processes = array();
                            foreach ($records as $record) {
                                $process_title = $record->process_title;
                                if (!isset($processes[$process_title])) {
                                    $processes[$process_title] = array();
                                }
                                $processes[$process_title][] = $record;
                                $process_ids[$process_title] = $record->process_id;
                            } ?>

                            <?php foreach ($processes as $process_title => $sub_records) : ?>
                                <div class="card mb-2">
                                    <div class="">
                                        <button class="btn btn-sm btn-block default" data-toggle="collapse" data-target="#<?= str_replace(" ", "_", $process_title) ?>">
                                            <h6 class="font-weight-bold"><?= ucwords($process_title) ?></h6>
                                        </button>
                                    </div>
                                    <div id="<?= str_replace(" ", "_", $process_title) ?>" class="collapse">
                                        <div class="card-body">
                                            <?php foreach ($sub_records as $sub_record) : ?>
                                                <div class="card mb-2">
                                                    <div class="">
                                                        <button class="btn btn-xs btn-block default d-flex justify-content-between" data-toggle="collapse" data-target="#<?= str_replace(" ", "_", $sub_record->checklist_title) ?>">
                                                            <h6><?= ucwords($sub_record->checklist_title) ?></h6>
                                                            <i class=" checklist-bell checklist-status <?= $sub_record->status == 1 ? "simple-icon-check text-success" : "simple-icon-clock text-danger" ?>"></i>
                                                        </button>
                                                    </div>
                                                    <div id="<?= str_replace(" ", "_", $sub_record->checklist_title) ?>" class="collapse">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-end">
                                                                <i class="checklist-bell <?= $sub_record->status == 0 ? "fa-regular fa-bell text-warning notify_checklist" : "" ?>" data-clid="<?= $sub_record->checklist_id ?>"></i>
                                                            </div>
                                                            <div class="row mb-1">
                                                                <div class="col-6">
                                                                    <label>Date 1</label>
                                                                    <input class="form-control date1" type="date" value="<?= $sub_record->date_1 ?? '' ?>" data-clid="<?= $sub_record->checklist_id ?>">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label>Date 2</label>
                                                                    <input class="form-control date2" type="date" value="<?= $sub_record->date_2 ?? '' ?>" data-clid="<?= $sub_record->checklist_id ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-1">
                                                                <div class="col-12">
                                                                    <form action="javascript:void(0)" class="upload_file" enctype="multipart/form-data">
                                                                        <div class="input-group">
                                                                            <input type="hidden" name="clid" value="<?= $sub_record->checklist_id ?>">
                                                                            <input class="form-control" type="file" name="doc" required>
                                                                            <div class="input-group-append">
                                                                                <button type="submit" class="btn btn-success btn-xs default"><i class="fa fa-upload"></i></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-1">
                                                                <div class="col-12">
                                                                    <textarea class="form-control comment" rows="3" data-clid="<?= $sub_record->checklist_id ?>" placeholder="Comments"><?= $sub_record->comments ?? '' ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php if ($sub_record->status == 1) : $go++;
                                                            $co++ ?>
                                                            <div class="card-footer">
                                                                <div class="row justify-content-center">
                                                                    <a class="badge badge-success" href="<?= base_url('Assets/docs/' . $sub_record->document_name) ?>" target="_blank">View Document</a>
                                                                </div>
                                                            </div>
                                                        <?php endif;
                                                        $gt++;
                                                        $ct++; ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="progress progress1 mt-3">
                                <div title="<?= intval((($co / $ct) * 100)) . "%" ?>" class="progress-bar bg-<?php if ((($co / $ct) * 100) < 50) {
                                                                                                                    echo "danger";
                                                                                                                } elseif ((($co / $ct) * 100) < 80) {
                                                                                                                    echo "warning";
                                                                                                                } else {
                                                                                                                    echo "success";
                                                                                                                } ?>" style="width: <?= (($co / $ct) * 100) ?>%;"><?= intval((($co / $ct) * 100)) ?>% [ <?= $co . " / " . $ct ?> ]</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $list_percentages[$list_ids[$key]] = intval((($co / $ct) * 100)); ?>
            <?php endforeach; ?>
        </div>
    </section>
</div>
<div class="mt-3">
    <div title="<?= intval((($go / $gt) * 100)) . "%" ?>" class="progress-bar grnd-progress-bar row  bg-<?php if ((($go / $gt) * 100) < 50) {
                                                                                                            echo "danger";
                                                                                                        } elseif ((($go / $gt) * 100) < 80) {
                                                                                                            echo "warning";
                                                                                                        } else {
                                                                                                            echo "success";
                                                                                                        } ?>" style="width: <?= (($go / $gt) * 100) ?>%;"><?= intval((($go / $gt) * 100)) ?>%</div>
</div>
<script>
    var list_percentages = JSON.parse('<?= json_encode($list_percentages) ?>');
</script>
<script src="<?= base_url('Assets/js/custum/project_details_view.js'); ?>"></script>
<script src="<?= base_url('Assets/js/plugins/sweetalert2.js'); ?>"></script>