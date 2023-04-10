<div class="container-fluid disable-text-selection">
    <div class="col-12 list" data-check-all="checkAll">
        <?php if ($check == 1) : ?>
            <section class="content-header">
                <h1>
                    <?php echo $pageHeading; ?> : "<?= $project[0]->project_name ?>"
                </h1>
            </section>
            <hr>
            <div class="row flex-nowrap card-row">
                <?php $gpm = 0;
                $gpc = 0;
                foreach ($lists as $list) : $max = 0;
                    $curr = 0; ?>
                    <div class="card card-1 position-relative col-lg-3 round_corner round_corner2 mb-3">
                        <div class="card-header mt-3">
                            <h6 class="overFlowTitle" data-toggle="tooltip" data-placement="top" data-original-title="<?= $list->title ?>"><?= $list->title ?></h6>
                        </div>
                        <div class="card-body">
                            <p class="list-item-heading">
                                <?php foreach ($documents as $document) : ?>
                                    <?php if ($document->checklists_list_id == $list->id) : ?>
                                        <?php if (!empty($document->file_name)) {
                                            $curr++;
                                            $gpc++;
                                        } ?>
                                        <label class="form-group has-float-label mb-4">
                                            <p class=" form-control overflow_front"><?= $document->title ?></p>
                                            <p class="text-small text-<?= (!empty($document->file_name)) ? 'success' : 'danger'; ?>"><?= (!empty($document->file_name)) ? 'Uploaded' : 'Missing'; ?></p>
                                        </label>
                                    <?php $max++;
                                        $gpm++;
                                    endif; ?>
                                <?php endforeach; ?>
                            </p>
                            <footer>
                                <?php if (empty($curr || $max)) { ?>
                                    <?php print_r('No Checklists Added Yet'); ?>
                                <?php } else { ?>
                                    <?php if ((($curr / $max) * 100) != 0) : ?>
                                        <div class="progress progress1">
                                            <div class="progress-bar bg-<?php if ((($curr / $max) * 100) < 50) {
                                                                            echo "danger";
                                                                        } elseif ((($curr / $max) * 100) < 80) {
                                                                            echo "warning";
                                                                        } else {
                                                                            echo "success";
                                                                        } ?>" style="width: <?= (($curr / $max) * 100) ?>%;"><?= intval((($curr / $max) * 100)) ?>%</div>
                                        </div>
                                    <?php else : ?>
                                        <p class=" text-danger text-small">No Document Uploaded</p>
                                    <?php endif; ?>
                                <?php } ?>
                            </footer>
                        </div>
                    </div>
                <?php endforeach;  ?>
            </div>
    </div>
    <div class="col-12 mb-5">
        <?php if (empty($gpc || $gpm)) { ?>
            <?php print_r(''); ?>
        <?php } else { ?>
            <div class="mt-3">
                <div title="intval" class="progress-bar grnd-progress-bar row  bg-<?php if ((($gpc / $gpm) * 100) < 50) {
                                                                                        echo "danger";
                                                                                    } elseif ((($gpc / $gpm) * 100) < 80) {
                                                                                        echo "warning";
                                                                                    } else {
                                                                                        echo "success";
                                                                                    } ?>" style="width: <?= (($gpc / $gpm) * 100) ?>%;"><?= intval((($gpc / $gpm) * 100)) ?>%</div>
            </div>
        <?php } ?>
    </div>
</div>
<?php else : ?>
    <div class="text-large text-center text-info"><?= $page_text; ?></div>
<?php endif; ?>
</div>
</div>
<script>
    var base_url = '<?= base_url() ?>';
</script>