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
    .list-card{
        min-height: 500px;
    }
</style>
<script src="<?= base_url('Assets/js/vendor/jquery-3.3.1.min.js') ?>"></script>
<div class="container-fluid disable-text-selection">
    <div class="col-12 list" data-check-all="checkAll">
        <?php if ($load_data == 1) : ?>
            <section class="content-header mb-5">
                <h1 class="ml-0 text-large"><?= $pageHeading ?? "NULL"; ?></h1>
            </section>
            <section class="container">
                <div class="row flex-nowrap card-row">
                    <?php
                    $gt = 0;
                    $go = 0;
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
                        <div class="col-4 mb-2">
                            <div class="card round_corner mt-2 list-card">
                                <div class=" d-flex justify-content-between">
                                    <h2 class="card-header mt-2 text-truncate" data-toggle="tooltip" data-placement="top" data-original-title="<?= $key ?>">
                                        <?= $key ?>
                                    </h2>
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
                                    } ?>

                                    <?php foreach ($processes as $process_title => $sub_records) : ?>
                                        <div class="card mb-3">
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
                                                                    <div class="row mb-1">
                                                                        <div class="col-6">
                                                                            <label>Date 1</label>
                                                                            <input class="form-control" type="date" value="<?= $sub_record->date_1 ?? '' ?>" disabled>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label>Date 2</label>
                                                                            <input class="form-control" type="date" value="<?= $sub_record->date_2 ?? '' ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-1">
                                                                        <div class="col-12">
                                                                            <textarea class="form-control comment" rows="3" placeholder="Comments" disabled><?= $sub_record->comments ?? '' ?></textarea>
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
                    <?php endforeach; ?>
                </div>
            </section>
            <div class="mt-3">
                <div title="<?= intval((($go / $gt) * 100)) . "%" ?>" class="progress-bar grnd-progress-bar row  bg-<?php if ((($go / $gt) * 100) < 50) {
                                                                                                                        echo "danger";
                                                                                                                    } elseif ((($go / $gt) * 100) < 80) {
                                                                                                                        echo "warning";
                                                                                                                    } else {
                                                                                                                        echo "success";
                                                                                                                    } ?>" style="width: <?= (($go / $gt) * 100) ?>%;"><?= intval((($go / $gt) * 100)) ?>%</div>
            </div>
        <?php else : ?>
            <div class="text-large text-center text-info"><?= $page_text; ?></div>
        <?php endif; ?>
    </div>
</div>
<script>
    var base_url = '<?= base_url() ?>';
    $('.collapsed').click(function() {
        $(this).find('.arrow').toggleClass('simple-icon-arrow-down simple-icon-arrow-up');
    });
</script>