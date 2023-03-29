<div class="card-body">
    <h2><?= $pageHeading ?> | <?= $project[0]->project_name ?></h2>
    <hr>
</div>
<div class="row">
    <?php $gpm=0; $gpc=0; foreach ($lists as $list): $max=0; $curr=0;?>
        <div class="card col-lg-<?= ($list_count > 4) ? 2 : 3; ?> round_corner mb-3">
            <div class="card-header mt-3">
                <h6 class="overFlowTitle" data-toggle="tooltip" data-placement="top" data-original-title="<?= $list->title ?>"><?= $list->title ?></h6>
            </div>
            <div class="card-body">
                <p class="list-item-heading mb-4">
                    <?php foreach ($documents as $document) :?>
                        <?php if ($document->checklists_list_id == $list->id) : ?>
                            <label class="form-group has-float-label mb-4">
                                <input type="<?php if (!empty($document->file_name)){echo "text"; }else{echo"file";} ?>" placeholder="<?php if (!empty($document->file_name)){echo "File Uploaded"; } ?>" data-checklist_id="<?= $document->id ?>" data-list_id="<?= $list->id ?>" data-project_id="<?= $project[0]->id ?>" class="form-control" onchange="upload_file(this)" <?php if (!empty($document->file_name)){echo "disabled"; } ?> >
                                <span class="text-small text-<?= (!empty($document->file_name))?"success":"danger";?> overflow" data-toggle="tooltip" data-placement="top" data-original-title="<?= $document->title?>"><?= $document->title ?></span>
                                <?php if (!empty($document->file_name)) : ?>
                                    <a class="text-small text-muted" target="_blank" href="<?= base_url('Assets/docs/') . $document->file_name ?>">View Uploaded Document</a>
                                <?php $curr++; $gpc++; endif; ?>
                            </label>
                        <?php $max++; $gpm++; endif; ?>
                    <?php endforeach;?>
                </p>
                <footer>
                    <?php if((($curr/$max)*100)!=0): ?>
                    <div class="progress-bar round_corner bg-<?php if ((($curr/$max)*100) < 50) {echo "danger";} elseif ((($curr/$max)*100) < 80){echo"warning";} else {echo "success";} ?>" style="width: <?= (($curr/$max)*100) ?>%;"><?= intval((($curr/$max)*100)) ?>%</div> 
                    <?php else: ?>
                        <p class="text-muted text-danger text-small">No Document Uploaded</p>
                    <?php endif; ?>

                </footer>
            </div>
        </div>
    <?php endforeach;  ?>
</div>
<hr>
<h2>Grand Progress</h2>

<div class="progress-bar row mt-2 round_corner bg-<?php if ((($gpc/$gpm)*100) < 50) {echo "danger";} elseif ((($gpc/$gpm)*100) < 80){echo"warning";} else {echo "success";} ?>" style="width: <?= (($gpc/$gpm)*100) ?>%;"><?= intval((($gpc/$gpm)*100)) ?>%</div> 
